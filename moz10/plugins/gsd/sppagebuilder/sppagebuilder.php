<?php

/**
 * @package         Google Structured Data
 * @version         4.0.7 Pro
 *
 * @author          Tassos Marinos <info@tassos.gr>
 * @link            http://www.tassos.gr
 * @copyright       Copyright © 2018 Tassos Marinos All Rights Reserved
 * @license         GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
 */

defined('_JEXEC') or die('Restricted access');

/**
 *  SP Page Builder Google Structured Data Plugin
 */
class plgGSDSPPageBuilder extends GSD\PluginBase
{
	/**
	 *  Get page's data
	 *
	 *  @return  array
	 */
	public function viewPage()
	{
		// Load current item via model
		$model = JModelLegacy::getInstance('Page', 'SppagebuilderModel');
		$item  = $model->getItem();

		// Array data
		return array(
			'id'    	  => $item->id,
			'headline'    => $item->title,
			'created_by'  => $item->created_by,
			'created'     => $item->created_on,
			'modified'    => $item->modified,
			'publish_up'  => $item->created_on
		);
	}

    /**
	 * The MapOptions Backend Event. Triggered by the mappingoptions fields to help each integration add its own map options.
	 *  
	 * @param	string	$plugin
	 * @param	array	$options
	 *
	 * @return	void
	 */
    public function onMapOptions($plugin, &$options)
    {
		if ($plugin != $this->_name)
        {
			return;
		}
		
		$remove_options = [
			'publish_down',
			'ratingValue',
			'reviewCount',
			'alias'
		];
		
		// Remove unsupported mapping options
		foreach ($remove_options as $key => $option)
		{
			unset($options['GSD_INTEGRATION']['gsd.item.' . $option]);
		}
	}
}
