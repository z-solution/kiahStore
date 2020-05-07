<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopOwner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'store_name',
    ];
}
