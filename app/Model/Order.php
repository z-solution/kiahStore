<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const UNPAID = 0; //dont show
    const PAID = 1; // cancel refund
    const PAIDFAIL = 2;  // nothing
    const PROCESSING = 3; // cancel refund 
    const SHIPPING = 4; // Track
    const COMPLETE = 5; // nothing
    const CANCEL = 6; // dont show
    const REFUNDREQUEST = 7; // nothing
    const REFUNDED = 8; // nothing
    const STATUSNAME = [
        'unpaid',
        'paid',
        'paidfail',
        'processing',
        'shipping',
        'complete',
        'cancel',
        'refund request',
        'refunded'
    ];
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
