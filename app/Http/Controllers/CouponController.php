<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Coupon;

// use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();

        return view('shopOwner.coupon', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request->all());

        $this->validate($request, [
            'coupon_code'  => 'required',
            'coupon_value' => 'required',
            'expiry_date' => 'required|date|date_format:Y-m-d',
        ]);

        $coupon = new Coupon();

        $coupon->code               = request('coupon_code');
        $coupon->value              = request('coupon_value');
        $coupon->expiration_date    = request('expiry_date');


        $coupon->save();

        return redirect('/coupon')->with('success', 'New coupon added');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);

        // dd($coupon);

        return view('shopOwner.couponCRUD', compact('coupon', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'coupon_code'    => 'required',
            'coupon_value'   => 'required',
            'expiry_date'    => 'required|date|date_format:Y-m-d',
        ]);

        $coupon = Coupon::find($id);
        
        $coupon->code                   = $request->get('coupon_code');
        $coupon->value                 = $request->get('coupon_value');
        $coupon->expiration_date       = $request->get('expiry_date');
    
        $coupon->save();
        return redirect('/coupon')->with('success', 'Data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
