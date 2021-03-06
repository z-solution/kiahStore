<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryVariant extends Model
{
    use SoftDeletes;
    /**
     * Get the inventory for this inventory variant.
     */
    public function inventory()
    {
        return $this->belongsTo('App\Model\Inventory');
    }

    /**
     * Get the cart items for the iventory variant.
     */
    public function cartItems()
    {
        return $this->hasMany('App\Model\CartItem');
    }
    
    /**
     * Get the order items for the iventory variant.
     */
    public function orderItems()
    {
        return $this->hasMany('App\Model\OrderItem');
    }
}
