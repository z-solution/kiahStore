<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the billing address for this order.
     */
    public function billingAddress()
    {
        return $this->belongsTo('App\Model\Address', 'blling_address_id');
    }

    /**
     * Get the shipping address for this order.
     */
    public function shippingAddress()
    {
        return $this->belongsTo('App\Model\Address', 'shipping_address_id');
    }

    /**
     * Get the customers for this order.
     */
    public function customer()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    /**
     * Get the order items for this order.
     */
    public function orderItem()
    {
        return $this->hasMany('App\Model\OrderItem', 'orderItem_id');
    }

}
