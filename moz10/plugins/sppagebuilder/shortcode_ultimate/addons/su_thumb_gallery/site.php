<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonSu_thumb_gallery extends SppagebuilderAddons{

	public function render(){

		// Prepare compatibility mode prefix
		$prefix    = su_cmpt();
		
		$limit     = (isset($this->addon->settings->limit) && $this->addon->settings->limit) ? $this->addon->settings->limit : '20';
		$width     = (isset($this->addon->settings->width) && $this->addon->settings->width) ? $this->addon->settings->width : '850';
		$height    = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : '478';
		
		$caption   = ( $this->addon->settings->caption == 1 ) ? 'yes' : 'no';
		
		$class     = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$order     = (isset($this->addon->settings->order) && $this->addon->settings->order) ? $this->addon->settings->order : '';
		$order_by  = (isset($this->addon->settings->order_by) && $this->addon->settings->order_by) ? $this->addon->settings->order_by : '';
		$style     = (isset($this->addon->settings->style) && $this->addon->settings->style) ? $this->addon->settings->style : '';
		$zoom_type = (isset($this->addon->settings->zoom_type) && $this->addon->settings->zoom_type) ? $this->addon->settings->zoom_type : '';

		if ( isset($this->addon->settings->source_type) && $this->addon->settings->source_type == 'category' ) {
			$j_category = isset($this->addon->settings->j_category) && $this->addon->settings->j_category ? rtrim(implode(',', $this->addon->settings->j_category), ',') : '';
			$source     = 'category: '.$j_category;
		}
		elseif ( isset($this->addon->settings->source_type) && $this->addon->settings->source_type == 'k2-category' ) {
			$k2_category = isset($this->addon->settings->k2_category) && $this->addon->settings->k2_category ? rtrim(implode(',', $this->addon->settings->k2_category), ',') : '';
			$source      = 'k2-category: '.$k2_category;
		}
		elseif ( isset($this->addon->settings->source_type) && $this->addon->settings->source_type == 'directory' ) {
			$source = isset($this->addon->settings->dir_path) && $this->addon->settings->dir_path ? 'directory: '.$this->addon->settings->dir_path : '';
		}
		elseif ( isset($this->addon->settings->source_type) && $this->addon->settings->source_type == 'media' ) {
			$source = isset($this->addon->settings->med_library) && $this->addon->settings->med_library ? 'media: '.$this->addon->settings->med_library : '';
		}

		// Output
		$output = '<div class="bdt-addon bdt-addon-thumb-gallery ' . $class .'">';
		$output .= su_do_shortcode('['.$prefix.'thumb_gallery style="'.$style.'" source="'.$source.'" limit="'.$limit.'" caption="'.$caption.'" order="'.$order.'" order_by="'.$order_by.'" width="'.$width.'" height="'.$height.'" zoom_type="'.$zoom_type.'"]');
		$output .= '</div>';

		return $output;
	}
}
