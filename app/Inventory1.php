<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Inventory1 extends Model
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
