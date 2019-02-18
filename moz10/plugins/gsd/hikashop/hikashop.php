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
use Joomla\Registry\Registry;

/**
 *   Google Structured Data Plugin
 */
class plgGSDHikaShop extends PluginBaseProduct
{
    /**
     *  Discover HikaShop Product ID. 
     *  
     *  When the product is attached to a menu item Hikashop uses the product_id parameter to represent the product's ID. 
     *  Otherwise it uses the cid parameter. Why guys? 
     *
     *  @return  string
     */
    protected function getThingID()
    {
        // First check if the cid parameter is available
        if ($cid = $this->app->input->getInt('cid'))
        {
            return $cid;
        }

        // Otherwise return the product_id parameter
        return $this->app->input->getInt('product_id');
    }

    /**
     *  Product View
     *  
     *  @return  object
     */
    protected function viewProduct()
    {
        if (!$product = $this->getProduct($this->getThingID()))
        {
            return;
        }

        $price = $product->price > 0 ? $product->price : $product->retailPrice;

        // Prepare Data
        $data = array(
			'id'          => $product->id,
			'alias'       => $product->alias,
            "headline"    => $product->title,
            "description" => $product->description,
            "image"       => JURI::base() . hikashop_config()->get('uploadfolder') . $product->image,
            "offerPrice"  => Helper::formatPrice($price),
            "currency"    => $this->getCurrency(),
            "brand"       => $product->brandName,
            "ratingValue" => $product->ratingValue,
            "reviewCount" => $product->reviewCount,
            "sku"         => $product->sku
        );

        return $data;
    }

    private function getProduct($id)
    {
        if (!$id)
        {
            return;
        }

        // Fetch data from DB
        $db = $this->db;
        $query = $db->getQuery(true)
            ->select(
                array(
                    'p.product_id as id', 
                    'p.product_alias as alias', 
                    'p.product_name as title', 
                    'p.product_description as description', 
                    'p.product_code as sku',
                    'p.product_average_score as ratingValue',
                    'p.product_total_vote as reviewCount',
                    'f.file_path as image',
                    'c.category_name as brandName',
                    'p.product_msrp as retailPrice',
                    'pr.price_value as price'
                ))
            ->from('#__hikashop_product as p')
            ->where('p.product_id = ' . $db->q($id))
            ->join('LEFT', '#__hikashop_file as f on p.product_id = f.file_ref_id AND f.file_type = "product"')
            ->join('LEFT', '#__hikashop_category as c on p.product_manufacturer_id = c.category_id AND c.category_type = "manufacturer"')
            ->join('LEFT', '#__hikashop_price as pr on p.product_id = pr.price_product_id')

            ->setLimit('1');

        $db->setQuery($query);

        return $db->loadObject();
    }

    /**
     *  Get HikaShop default currency code
     *
     *  @return  string
     */
    private function getCurrency()
    {
        $currencyHelper   = hikashop_get('class.currency');
        $configCurrencyID = hikashop_getCurrency();

        $currencies = null;
        $currencies = $currencyHelper->getCurrencies($configCurrencyID, $currencies);
        $currency   = $currencies[$configCurrencyID];

        return (isset($currency->currency_code)) ? $currency->currency_code : "";
    }

	/**
	 * Listening to the onAfterRender Joomla event
	 *
	 * @return void
	 */
	public function onAfterRender()
	{
        // Make sure we are on the right context
        if ($this->app->isAdmin() || 
            !$this->passContext() || 
            $this->getView() != 'product' ||
            !$this->params->get('remove_hikashop_product_schema', true))
		{
            return;
        }

        // Remove Hikashop Product microdata
        Helper::removeSchemaFromBody('Product');
	}
}
