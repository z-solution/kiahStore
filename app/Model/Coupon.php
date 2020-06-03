<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

	protected $table = 'coupons';

    protected $dates = [
        'expiration_date'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'value'
    ];
}
