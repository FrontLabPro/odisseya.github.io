<?php
/*-------------------------------------------------------------------------
# cnt_go_pricing - Content - Go Pricing
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

class PlgContentLoadGoPricing extends JPlugin
{

	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer') return true;

		// Simple performance check to determine whether bot should process further
		if (stripos($article->text, '{go_pricing') === false) return true;

		// Expression to search for(modules)
		$regex = '/{go_pricing\s+id="?(.*?)"?(\s+margin_bottom="?(.*?)"?)?}/i';
		preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);

		if ($matches) {
  		foreach ($matches as $match){
  		  $id = $match[1];
				$margin_bottom = count($match) > 2 ? $match[3] : 0;
        jimport( 'joomla.application.module.helper' );
        $module = JModuleHelper::getModule('mod_go_pricing', 'Go Pricing'.rand());
        $attribs['style'] = 'none';
        $id = str_replace("&quot;", "", $id);
				$args = array('margin_bottom' => $margin_bottom);
				$args[ preg_match('/^\d+$/', $id) ? 'postid' : 'id' ] = $id;
				$module->params = json_encode($args);
  		  $output = JModuleHelper::renderModule( $module, $attribs );
  		  $article->text = preg_replace($regex, addcslashes($output, '\\$'), $article->text, 1);
  		}
    }
	}

}
