<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\User;
use Auth;
use Hash;

class ShopOwnerController extends Controller
{
    public function index(){

        $orderCount = Order::where('shop_id', Auth::user()->id );
        $customerCount = User::where('customer_shop_id', Auth::user()->owner_shop_id );
        $salesCount = Order::where('shop_id', Auth::user()->id);
    	return view('shopOwner.index', compact(['orderCount', 'customerCount', 'salesCount']));
    }


	/**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required|same:confirm-password',
            'store_name' => 'required'
        ]);

        $shopOwner = new ShopOwner();
       
        $shopOwner->name = request('name');
        $shopOwner->email = request('email');
        $shopOwner->phone = request('phone');
        $shopOwner->store_name = request('store_name');
        $shopOwner->password = Hash::make(request('password'));

        $shopOwner->save();

        return redirect('/')->with('success', 'Shop Owner added');
    }
}


