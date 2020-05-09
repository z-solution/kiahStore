<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    
    /**
     * Get the shop for this inventory.
     */
    public function shop()
    {
        return $this->belongsTo('App\Model\Shop');
    }

    /**
     * Get the inventory variant for the inventory.
     */
    public function inventoryVariant()
    {
        return $this->hasMany('App\Model\InventoryVariant');
    }
}
