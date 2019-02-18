<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonSu_testimonial extends SppagebuilderAddons{

	public function render(){

		// Prepare compatibility mode prefix
		$prefix       = su_cmpt();
		
		$content      = (isset($this->addon->settings->content) && $this->addon->settings->content) ? $this->addon->settings->content.'[/'.$prefix.'testimonial]' : '';
		
		$italic       = ( $this->addon->settings->italic == 1 ) ? 'yes' : 'no';
		
		$class        = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$style        = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : '';
		$name         = (isset($this->addon->settings->name) && $this->addon->settings->name) ? $this->addon->settings->name : '';
		$title        = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$photo        = (isset($this->addon->settings->photo) && $this->addon->settings->photo) ? $this->addon->settings->photo : '';
		$company      = (isset($this->addon->settings->company) && $this->addon->settings->company) ? $this->addon->settings->company : '';
		$url          = (isset($this->addon->settings->url) && $this->addon->settings->url) ? $this->addon->settings->url : '';
		$target       = (isset($this->addon->settings->target) && $this->addon->settings->target) ? $this->addon->settings->target : '';
		$radius       = (isset($this->addon->settings->radius) && $this->addon->settings->radius) ? $this->addon->settings->radius : '';
		$color        = (isset($this->addon->settings->color) && $this->addon->settings->color) ? $this->addon->settings->color : '';
		$background   = (isset($this->addon->settings->background) && $this->addon->settings->background) ? $this->addon->settings->background : '';
		$border_color = (isset($this->addon->settings->border_color) && $this->addon->settings->border_color) ? $this->addon->settings->border_color : '';

		// Output
		$output = '<div class="bdt-addon bdt-addon-testimonial ' . $class .'">';
		$output .= su_do_shortcode('['.$prefix.'testimonial style="'.$style.'" name="'.$name.'" title="'.$title.'" photo="'.$photo.'" company="'.$company.'" url="'.$url.'" target="'.$target.'" italic="'.$italic.'" radius="'.$radius.'" color="'.$color.'" background="'.$background.'" border_color="'.$border_color.'"]'.$content);
		$output .= '</div>';

		return $output;
	}
}
