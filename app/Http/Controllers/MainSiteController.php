<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shopOwner;
use Hash;

class MainSiteController extends Controller
{
    public function signUp(){
    	return view('signUp');
    }


	/**
     * Store a newly created resource in storage.
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


