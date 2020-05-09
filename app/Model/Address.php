<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Get the order using this address as billing address.
     */
    public function orderAsBillingAddress()
    {
        return $this->hasOne('App\Model\Order', 'billing_address_id');
    }

    /**
     * Get the order using this address as shipping address.
     */
    public function orderAsShippingAddress()
    {
        return $this->hasOne('App\Model\Order', 'shipping_address_id');
    }
}
