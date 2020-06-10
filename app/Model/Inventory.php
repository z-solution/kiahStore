<?php

namespace App\Model;

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
    
    /**
     * Get the inventory variant for the inventory.
     */
    public function cartItem()
    {
        return $this->hasMany('App\Model\CartItem');
    }

    /**
     * Get the attachment image for the inventory.
     */
    public function attachment()
    {
        return $this->hasMany('App\Model\Attachment');
    }

    /**
     * Get the first attachment filename for this inventory. If does not exist, returnd default image.
     */
    public function getFirstAttachmentFilename() {
        if($this->attachment && count($this->attachment)) {
            return '/' . $this->attachment[0]->filename;
        }
        return Inventory::getDefaultImage();
    }
    static function getDefaultImage() {
        return '/img/default_product.png';
    }
}
