<?php
/*-------------------------------------------------------------------------
# btn_go_pricing - Button - Go Pricing
# -------------------------------------------------------------------------
# @ author    Balint Polgarfi
# @ copyright Copyright (C) 2015 Offlajn.com  All Rights Reserved.
# @ license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# @ website   http://www.offlajn.com
-------------------------------------------------------------------------*/
$revision = '3.1.022';
$revision = '3.1.022';
defined('_JEXEC') or die;

class PlgButtonBtn_Go_Pricing extends JPlugin
{
	protected $autoloadLanguage = true;

	public function onDisplay($name)
	{
		JHtml::_('behavior.modal');
		JFactory::getDocument()->addScriptDeclaration("
		function jSelectGoPricing(id) {
			var tag = '{go_pricing id='+id+'}';
			jInsertEditorText(tag, '$name');
			SqueezeBox.close();
		}");

		$button = new JObject;
		$button->modal = true;
		$button->class = 'btn';
		$button->link = 'index.php?option=com_go_pricing&tmpl=component&list=1';
		$button->text = 'GoPricing';
		$button->title = 'Insert GoPricing table';
		$button->name = 'article icon-file-add';
		$button->options = "{handler: 'iframe', size: {x: 1020, y: 587}}";

		return $button;
	}
}
