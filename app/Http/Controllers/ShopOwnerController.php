<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\User;
use App\Model\Inventory1;
use App\Model\Shop;
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

    public function display(){
        $products = Inventory1::all();

        return view('shopOwner.product', compact('products'));
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
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'dimension' => 'required'
        ]);

        $inventory = new Inventory1();
        $inventory->shop_id = Auth::user()->owner_shop_id;
        $inventory->name = request('product_name');
        $inventory->description = request('description');
        $inventory->price = request('price');
        $inventory->quantity = request('quantity');
        $inventory->status = 1;
        $inventory->dimension = request('dimension');
        

        $inventory->save();

        return redirect('/product')->with('success', 'New product added');
    }

    public function edit($id){
        $product = Inventory::find($id);
        return view('shopOwner.productDetails', compact('product', 'id'));
    }
     
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'            => 'required',
            'name'            => 'required',
            'summary'         => 'required',
            'actual_time_out' => 'required',
            'actual_time_in'  => 'required',
            'mileage'         => 'required',
            'items_removed'   => 'required',
            'notes'           => 'required',
        ]);
        $log = Log::find($id);
        $log->car->name         = $request->get('name');
        $log->user->name        = $request->get('name');
        $log->summary           = $request->get('summary');
        $log->start_date        = $request->get('start_date');
        $log->end_date          = $request->get('end_date');
        $log->location          = $request->get('location');
        $log->actual_time_out   = $request->get('actual_time_out');
        $log->actual_time_in    = $request->get('actual_time_in');
        $log->mileage           = $request->get('mileage');
        $log->gas_refill_needed = $request->get('gas_refill_needed');
        $log->items_removed     = $request->get('items_removed');
        $log->notes             = $request->get('notes');

        $log->save();
        return redirect('/checkinoutLog')->with('success', 'Data updated');
    }
}


