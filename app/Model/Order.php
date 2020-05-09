<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the billing address for this order.
     */
    public function billingAddress()
    {
        return $this->belongsTo('App\Model\Address', 'billing_address_id');
    }

    /**
     * Get the shipping address for this order.
     */
    public function shippingAddress()
    {
        return $this->belongsTo('App\Model\Address', 'shipping_address_id');
    }
}
