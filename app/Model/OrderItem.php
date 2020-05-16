<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * Get the inventory variant for this order item.
     */
    public function inventoryVariant()
    {
        return $this->belongsTo('App\Model\InventoryVariant');
    }
    
    /**
     * Get the order for this order item.
     */
    public function order()
    {
        return $this->belongsTo('App\Model\Order');
    }
}
