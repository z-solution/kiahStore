<?php

namespace App\Http\Controllers;

use App\Model\ActionLog;
use Illuminate\Http\Request;
use App\Model\Coupon;

use Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::where('shop_id', Auth::user()->owner_shop_id)->get();

        return view('shopOwner.coupon', compact('coupons'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreateCoupon()
    {
        return view('/shopOwner/createCoupon');
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
        ]);

        $coupon = new Coupon();

        $coupon->shop_id     = Auth::user()->owner_shop_id;
        $coupon->code               = request('coupon_code');
        $coupon->value              = request('coupon_value');

        $coupon->save();
        ActionLog::shopAddCoupon(Auth::user()->owner_shop_id, Auth::user()->id, $coupon->id);
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

    public function deleteCoupon(Request $request)
    {
        $couponId = $request->input('couponId');
        $coupon = Coupon::find($couponId);
        $coupon->delete();
        ActionLog::shopDeleteCoupon(Auth::user()->owner_shop_id, Auth::user()->id, $coupon->id);
        return redirect('/coupon')->with('success', 'Coupon deleted');
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
        ]);

        $coupon = Coupon::find($id);

        $coupon->code                   = $request->get('coupon_code');
        $coupon->value                 = $request->get('coupon_value');

        $coupon->save();
        
        ActionLog::shopUpdateCoupon(Auth::user()->owner_shop_id, Auth::user()->id, $coupon->id);
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
