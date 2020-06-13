<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMINTYPE = 0;
    const SHOPOWNERTYPE = 1;
    const CUSTOMERTYPE = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'owner_shop_id', 'customer_shop_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the shop for this user as shop owner.
     */
    public function shopAsShopOwner()
    {
        return $this->belongsTo('App\Model\Shop', 'owner_shop_id');
    }

    /**
     * Get the shop for this user as customer.
     */
    public function shopAsCustomer()
    {
        return $this->belongsTo('App\Model\Shop', 'customer_shop_id');
    }

    /**
     * Get the carts for the shop.
     */
    public function carts()
    {
        return $this->hasMany('App\Model\Cart');
    }

    /**
     * Get the orders for the shop.
     */
    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

    /**
     * Get the attachment image for the user.
     */
    public function attachment()
    {
        return $this->hasMany('App\Model\Attachment');
    }

    static public function createShopOwner(array $data)
    {
        $data['type'] = User::SHOPOWNERTYPE;
        return User::create($data);
    }

    static public function createAdmin(array $data)
    {
        $data['type'] = User::ADMINTYPE;
    }
    
    static public function createCustomer(array $data)
    {
        $data['type'] = User::CUSTOMERTYPE;
        return User::create($data);
    }

    static public function countShopOwner() {
        return User::where('type', User::SHOPOWNERTYPE)->count();
    }
    
    static public function countAdmin() {
        return User::where('type', User::ADMINTYPE)->count();
    }

    static public function countCustomer() {
        return User::where('type', User::CUSTOMERTYPE)->count();
    }

    static public function getCustomer() {
        return User::where('type', User::CUSTOMERTYPE)->get();
    }
}
