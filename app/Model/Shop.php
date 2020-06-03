<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    const STATUS = ['pending' => 0,'Approve' => 1];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the orders for the shop.
     */
    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    /**
     * Get the inventories for the shop.
     */
    public function inventories()
    {
        return $this->hasMany('App\Model\Inventory');
    }

    /**
     * Get the carts for the shop.
     */
    public function carts()
    {
        return $this->hasMany('App\Model\Cart');
    }

    /**
     * Get the attachment for the shop.
     */
    public function attachments()
    {
        return $this->hasMany('App\Model\Attachment');
    }

    /**
     * Get the customers for the shop.
     */
    public function userAsCustomers()
    {
        return $this->hasMany('App\Model\User', 'customer_shop_id');
    }


    /**
     * Get the shop owner for the shop.
     */
    public function userAsShopOwner()
    {
        return $this->hasOne('App\Model\User', 'owner_shop_id');
    }

    /**
     * Approve the shop.
     */
    static public function approveShop($id) {
        $shop = Shop::find($id);
        $shop->status = Shop::STATUS['Approve'];
        $shop->save();

        return $shop;
    }

    public function isApproved() {
        return $this->status == 1;
    }
}
