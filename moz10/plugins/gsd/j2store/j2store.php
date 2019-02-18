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

use GSD\Helper;
use GSD\PluginBaseProduct;
use NRFramework\Extension;

/**
 *  J2Store Google Structured Data Plugin
 * 
 *  Note: If a J2Store Product is assigned to a Single Article menu type the plugin doesn't recognize the product.
 *  https://www.j2store.org/component/kunena/2-general-questions/5487-single-product-from-menu-item.html
 */
class plgGSDJ2Store extends PluginBaseProduct
{
	/**
	 *  Get article's data
	 *
	 *  @return  array
	 */
	public function viewProducts()
	{
		// Make sure J2Store is loaded
		if (!class_exists('J2Product'))
		{
			return;
		}

		// Make sure we have a valid ID
		if (!$id = $this->getThingID())
		{
			return;
		}

		// Get product information
		$item = J2Product::getInstance()->setId($id)->getProduct();

		if (!is_object($item) || !isset($item->source))
		{
			return;
		}

		// Array data
		$payload = [
			'id'   		   => $item->source->id,
			'alias'        => $item->source->alias,
			'headline'     => $item->product_name,
			'description'  => isset($item->product_short_desc) && !empty($item->product_short_desc) ? $item->product_short_desc : $item->product_long_desc,
			'image'        => $item->main_image,
			'offerPrice'   => $item->pricing->price,
			'currency'	   => J2Currency::getInstance()->getCode(),
			'brand'	       => $item->manufacturer,
			'sku'		   => $item->variant->sku,
			'created_by'   => $item->source->created_by,
			'created'      => $item->source->created,
			'modified'     => $item->source->modified,
			'publish_up'   => $item->source->publish_up,
			'publish_down' => $item->source->publish_down,
			'ratingValue'  => isset($item->source->rating) ? $item->source->rating : null,
			'reviewCount'  => isset($item->source->rating_count) ? $item->source->ratring_count : null,
			'metakey'	   => $item->source->metakey,
			'metadesc'	   => $item->source->metadesc
		];

		return $payload;
	}

	/**
	 * Remove J2Store Product microdata from all page.
	 *
	 * @return void
	 */
	public function onAfterRender()
	{
        // Make sure we are on the right context
        if ($this->app->isAdmin() || !$this->params->get('removemicrodata', true))
		{
            return;
        }

        Helper::removeSchemaFromBody('Product', false, true);
	}
}
