<?php
/**
* @package RSFeedback!
* @copyright (C) 2010-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );

class plgSystemRsfeedback extends JPlugin
{
	public function __construct( &$subject, $config )
	{
		if (!JFactory::getApplication()->isAdmin()) 
			require_once(JPATH_SITE.'/components/com_rsfeedback/helpers/rsfeedback.php');

		parent::__construct( $subject, $config );
	}

	public function onAfterRoute()
	{
		$app 	= JFactory::getApplication();
		$option = $app->input->get('option', '', 'cmd');

		if (!$app->isAdmin() && $option == 'com_rsfeedback')
			$this->processRules();
	}

	/*----------------------------------AUTO MODERATION------------------------------------*/

	protected function processRules()
	{
		$db 	= JFactory::getDBO();
		$query 	= $db->getQuery(true);

		$query	->select($db->qn('m.flag_id').', '.$db->qn('m.limit').', '.$db->qn('m.action').', '.$db->qn('m.target'))
				->from($db->qn('#__rsfeedback_auto_moderation').' m ')
				->join('left', '#__rsfeedback_flags f ON '.$db->qn('f.id').' = '.$db->qn('m.flag_id'))
				->where($db->qn('m.published').' = '.$db->q(1))
				->where($db->qn('f.published').' = '.$db->q(1));
		$db->setQuery($query);

		//Get moderation rules
		$rules = $db->loadObjectList();
		if (!empty($rules))
		foreach ($rules as $rule) 
		{
			//delete feedbacks
			if ($rule->action == '3')
				$this->deleteFeedback($rule->flag_id,$rule->limit);

			//get all feedbacks that have the specified flag
			$query->clear();
			$query	->select('DISTINCT '.$db->qn('fl.feedback_id').', '.$db->qn('f.cat_id'))
					->from($db->qn('#__rsfeedback_user_flags', 'fl'))
					->join('left', $db->qn('#__rsfeedback_feedbacks','f').' ON '.$db->qn('f.id').' = '.$db->qn('fl.feedback_id'))
					->where($db->qn('flag_id').' = '.$db->q($rule->flag_id));
			$db->setQuery($query);
			$feedbacks = $db->loadObjectList();

			if (!empty($feedbacks))
			foreach ($feedbacks as $feedback)
			{
				//Get the number of times the flag appears
				$query->clear();
				$query	->select('COUNT('.$db->qn('flag_id').')')
						->from($db->qn('#__rsfeedback_user_flags'))
						->where($db->qn('feedback_id'). ' = '.$db->q($feedback->feedback_id))
						->where($db->qn('flag_id').' = '.$db->q($rule->flag_id))
						->group($db->qn('flag_id'));
				$db->setQuery($query);
				$feedbackFlagLimit = $db->loadResult();

				if($feedbackFlagLimit >= $rule->limit) 
				{
					//unpublish feedback
					if ($rule->action == 2) 
					{
						$query->clear();
						$query	->update($db->qn('#__rsfeedback_feedbacks'))
								->set($db->qn('published').' = '.$db->q('0'))
								->where($db->qn('id').' = '.$db->q($feedback->feedback_id));
						$db->setQuery($query);
						$db->execute();

					}

					//archive feedback
					if ($rule->action == 1) 
					{
						$query->clear();
						$query	->update($db->qn('#__rsfeedback_feedbacks'))
								->set($db->qn('published').' = '.$db->q('2'))
								->where($db->qn('id').' = '.$db->q($feedback->feedback_id));
						$db->setQuery($query);
						$db->execute();
					}

					//move feedback
					if ($rule->action == 4) 
						$this->moveFeedback($feedback->feedback_id,$rule->target);

					//auto-move feedback
					if ($rule->action == 5)
					{
						// get the most wanted destination category number of "wrong category" user flag 
						$query->clear();
						$query ->select($db->qn('fl.comment').', '.$db->qn('c.id', 'cat_id').', COUNT('.$db->qn('fl.id').') as flags_count')
							   ->from($db->qn('#__rsfeedback_user_flags','fl'))
							   ->join('left', $db->qn('#__rsfeedback_categories','c').' ON '.$db->qn('fl.comment').' = '.$db->qn('c.name'))
							   ->where($db->qn('fl.feedback_id').' = '.$db->q($feedback->feedback_id))
							   ->where($db->qn('fl.flag_id').' = '.$db->q('4'))
							   ->group($db->qn('fl.comment'))
							   ->order('COUNT('.$db->qn('fl.id').') DESC');
						
						$db->setQuery($query, 0,1);
						$destination_category = $db->loadObject();

						if ($feedback->cat_id != $destination_category->cat_id) 		// check if feedback_id si not already in this category 
							if ( $destination_category->flags_count >= $rule->limit) 	// check the rule limit 
								if ($destination_category->cat_id) 						// update the feedbacks cat_id to the specified category
									$this->moveFeedback($feedback->feedback_id, $destination_category->cat_id);
					}
				}
			}
		}
	}

	//delete feedback 
	protected function deleteFeedback($flag,$limit)
	{
		if ( !RSFeedbackHelper::isJ3() ) {
			jimport( 'joomla.application.component.model' );
			jimport( 'joomla.application.component.modellist');
		}
		
		JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_rsfeedback/models', 'RSFeedbackModel');
		$model_feedbacks = JModelLegacy::getInstance('Feedbacks', 'RSFeedbackModel', array(
			'option' => 'com_rsfeedback',
			'table_path' => JPATH_ADMINISTRATOR.'/components/com_rsfeedback/tables'
		));

		$db 			 = JFactory::getDBO();
		$query 			 = $db->getQuery(true);
		$query 	->select($db->qn('feedback_id'))
				->from($db->qn('#__rsfeedback_user_flags'))
				->where($db->qn('flag_id').' = '.$db->q($flag))
				->having('COUNT('.$db->qn('flag_id').') >= '.$db->q($limit));

		$db->setQuery($query);
		$feedbacks = $db->loadObjectList();

		if (!empty($feedbacks)) 
		foreach ($feedbacks as $feedback) {
			//remove feedback
			$model_feedbacks->delete($feedback->feedback_id, true);
		}
	}

	//move feedback
	protected function moveFeedback($feedback_id,$cat_id)
	{
		$db 	= JFactory::getDBO();
		$query 	= $db->getQuery(true);

		if (!empty($cat_id)) {
			$query->update($db->qn('#__rsfeedback_feedbacks'))->set($db->qn('cat_id').' = '.$db->q($cat_id))->where($db->qn('id').' = '.$db->q($feedback_id));
			$db->setQuery($query);
			$db->execute();
		}
	}
}
