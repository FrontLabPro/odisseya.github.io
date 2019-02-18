<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonSu_qrcode extends SppagebuilderAddons{

	public function render(){

		// Prepare compatibility mode prefix
		$prefix = su_cmpt();
		
		$size   = (isset($this->addon->settings->size) && $this->addon->settings->size) ? $this->addon->settings->size : '200';
		$margin = (isset($this->addon->settings->margin) && $this->addon->settings->margin) ? $this->addon->settings->margin : '0';
		
		$class  = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$data   = (isset($this->addon->settings->data) && $this->addon->settings->data) ? $this->addon->settings->data : '';
		$title  = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$align  = (isset($this->addon->settings->align) && $this->addon->settings->align) ? $this->addon->settings->align : '';
		$link   = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';
		$target = (isset($this->addon->settings->target) && $this->addon->settings->target) ? $this->addon->settings->target : '';

		// Output
		$output = '<div class="bdt-addon bdt-addon-qrcode ' . $class .'">';
		$output .= su_do_shortcode('['.$prefix.'qrcode data="'.$data.'" title="'.$title.'" size="'.$size.'" margin="'.$margin.'" align="'.$align.'" link="'.$link.'" target="'.$target.'"]');
		$output .= '</div>';

		return $output;
	}
}
