<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\User;
use App\Model\Inventory;
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
        $products = Inventory::all();

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
            'description'  => 'required',
            'price'        => 'required',
            'quantity'     => 'required',
            'dimension'    => 'required',
            'status'       => 'required'
        ]);

        $inventory = new Inventory();
        
        $inventory->shop_id = Auth::user()->owner_shop_id;
        $inventory->name = request('product_name');
        $inventory->description = request('description');
        $inventory->price = request('price');
        $inventory->quantity = request('quantity');
        $inventory->status = request('status');
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
            'product_name'    => 'required',
            'description'     => 'required',
            'price'           => 'required',
            'quantity'        => 'required',
            'status'          => 'required',
        ]);

        $product = Inventory::find($id);
        
        $product->name          = $request->get('product_name');
        $product->description   = $request->get('description');
        $product->price         = $request->get('price');
        $product->quantity      = $request->get('quantity');
        $product->status        = $request->get('status');

        $product->save();
        return redirect('/product')->with('success', 'Data updated');
    }
}


