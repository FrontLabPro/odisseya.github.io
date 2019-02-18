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

/**
 *  VirtueMart Google Structured Data Plugin
 */
class plgGSDVirtueMart extends PluginBaseProduct
{
    /**
     *  Indicates the query string parameter name that is used by the front-end component
     *
     *  @var  string
     */
    protected $thingRequestIDName = 'virtuemart_product_id';

	/**
     *  Product View
     *  
     *  @return  object
     */
	protected function viewProductDetails()
	{
        $id       = $this->getThingID();
        $product  = VmModel::getModel('Product')->getProduct($id);
        $currency = VmModel::getModel('currency')->getCurrency($this->app->getUserState('virtuemart_currency_id', null));
        $rating   = $this->getRating($id);

        // Prepare Data
        $data = [
            'id'          => $product->id,
            'alias'       => $product->slug,
            'headline'    => $product->product_name,
            'description' => $product->product_desc,
            'offerPrice'  => $this->getFormattedPrice($product->prices['salesPrice'], $currency->virtuemart_currency_id),
            'currency'    => $currency->currency_code_3,
            'image'       => $this->getImage($product->images),
            'brand'       => $product->mf_name,
            'ratingValue' => $rating['value'],
            'reviewCount' => $rating['count'],
            'sku'         => $product->product_sku
        ];

        // Add Custom Fields to payload
        if (isset($product->customfieldsSorted) && is_array($product->customfieldsSorted))
        {
            foreach ($product->customfieldsSorted as $custom_field_group)
            {
                if (!is_array($custom_field_group))
                {
                    continue;
                }

                foreach ($custom_field_group as $custom_field)
                {
                    if (!isset($custom_field->virtuemart_custom_id) || 
                        !isset($custom_field->customfield_value) || 
                        !is_string($custom_field->customfield_value))
                    {
                        continue;
                    }

                    // If a product uses a custom field more than once, the last value will be used only.
                    $key = 'cf.' . $custom_field->virtuemart_custom_id;
                    $data[$key] = $custom_field->customfield_value;
                }
            }
        }

        return $data;
    }

    /**
     *  Re-calculates and formats given price with a currency
     *
     *  @param   String     The product price
     *  @param   Integer    The currency id
     *
     *  @return  void
     */
    private function getFormattedPrice($price, $currency_id)
    {
        @include_once JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/currencydisplay.php';

        // Try to re-calculate the price using currency
        if (class_exists('CurrencyDisplay'))
        {
            $currencyHelper = CurrencyDisplay::getInstance($currency_id);
            $price = $currencyHelper->roundForDisplay($price);
        }

        return Helper::formatPrice($price);
    }

    /**
     *  Gets Virtuemart product rating
     *
     *  @param   Integer  $id  Product ID
     *
     *  @return  Array
     */
    private function getRating($id)
    {
        $ratingModel = VmModel::getModel('ratings');
        $rating = $ratingModel->getRatingByProduct($id);

        if (!is_object($rating) || !isset($rating->rating))
        {
            return [
                'value' => 0,
                'count' => 0
            ];
        }

        return [
            'value' => $rating->rating,
            'count' => $rating->ratingcount
        ];
    }

     /**
      * Return an array of Virtuemart Custom Fields
      *
      * @param  integer $product_id
      *
      * @return mixed   Array on success, Null on failure
      */
    private function getCustomFields($product_id)
    {
        $fields_model = VmModel::getModel('customfields');

        $custom_fields = $fields_model->getCustomEmbeddedProductCustomFields($product_id);

        return $custom_fields;
    }

    /**
     *  Returns VirtueMart product image
     *
     *  @param   array  $images   Product Images
     *
     *  @return  string
     */
    private function getImage($images)
    {
        if (!is_array($images) || count($images) == 0 || !isset($images[0]) || !isset($images[0]->file_url))
        {
            return;
        }

        return Helper::absURL($images[0]->file_url);
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
            $this->getView() != 'productdetails' ||
            !$this->params->get('remove_virtuemart_product_schema', true))
		{
            return;
        }

        // Remove the Product Structured Data item added by Virtuemart
        Helper::removeSchemaFromBody('Product');
	}
}
