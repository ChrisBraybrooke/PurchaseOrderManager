<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'customer_name', 'customer_order_ref', 'own_order_ref', 'billing_address_line1',
        'billing_address_line2', 'billing_address_town', 'billing_address_county', 'billing_address_postcode',
        'billing_address_country', 'use_billing_for_shipping', 'shipping_address_line1', 'shipping_address_line2',
        'shipping_address_town', 'shipping_address_county', 'shipping_address_postcode', 'shipping_address_country',
        'ship_date', 'arrive_date', 'order_info'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_info' => 'collection',
        'use_billing_for_shipping' => 'boolean'
    ];

    /**
     * Get the validation rules for creating the model.
     *
     *  @return Array
     */
    public function getCreateRules()
    {
        return [
            'company' => 'required|string',
            'customer_ref' => 'sometimes|required',
            'own_ref' => 'sometimes|required',

            'shipping_address_line1' => 'required_without:use_billing_for_shipping',
            'shipping_address_town' => 'required_without:use_billing_for_shipping',
            'shipping_address_county' => 'required_without:use_billing_for_shipping',
            'shipping_address_postcode' => 'required_without:use_billing_for_shipping',
            'shipping_address_country' => 'required_without:use_billing_for_shipping',

            'billing_address_line1' => 'required',
            'billing_address_town' => 'required',
            'billing_address_county' => 'required',
            'billing_address_postcode' => 'required',
            'billing_address_country' => 'required',

            'products' => 'sometimes|required|array',
            'products.*.code' => 'sometimes|required',
            'products.*.description' => 'sometimes|required',
            'products.*.quantity' => 'sometimes|required',
            'products.*.unit_price' => 'sometimes|required',
            'products.*.total' => 'sometimes|required',
        ];
    }

    /**
     * Return the correct shipping address line.
     *
     *  @var String $value
     *  @return Array
     */
    public function getBillingAddressPostcodeAttribute($value)
    {
        return strtoupper($value);
    }

    /**
     * Return the correct shipping address line.
     *
     *  @var String $value
     *  @return Array
     */
    public function getShippingAddressLine1Attribute($value)
    {
        return $this->use_billing_for_shipping ? $this->billing_address_line1 : $value;
    }

    /**
     * Return the correct shipping address line.
     *
     *  @var String $value
     *  @return Array
     */
    public function getShippingAddressLine2Attribute($value)
    {
        return $this->use_billing_for_shipping ? $this->billing_address_line2 : $value;
    }

    /**
     * Return the correct shipping address line.
     *
     *  @var String $value
     *  @return Array
     */
    public function getShippingAddressTownAttribute($value)
    {
        return $this->use_billing_for_shipping ? $this->billing_address_town : $value;
    }

    /**
     * Return the correct shipping address line.
     *
     *  @var String $value
     *  @return Array
     */
    public function getShippingAddressCountyAttribute($value)
    {
        return $this->use_billing_for_shipping ? $this->billing_address_county : $value;
    }

    /**
     * Return the correct shipping address line.
     *
     *  @var String $value
     *  @return Array
     */
    public function getShippingAddressPostcodeAttribute($value)
    {
        return strtoupper($this->use_billing_for_shipping ? $this->billing_address_postcode : $value);
    }

    /**
     * Return the correct shipping address line.
     *
     *  @var String $value
     *  @return Array
     */
    public function getShippingAddressCountryAttribute($value)
    {
        return $this->use_billing_for_shipping ? $this->billing_address_country : $value;
    }
}
