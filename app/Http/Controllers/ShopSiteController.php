<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Inventory;
use App\Model\Shop;
use Auth;
use Hash;

class ShopSiteController extends Controller {

    public function index(Request $request){
        $shop = $request->middlewareShop;
    	$items = Inventory::with('attachment')->where('shop_id', $shop->id)->get();

        return view('shop.index', compact('items'));
    }

    public function displayDetails(Request $request, $id){
        $shop = $request->middlewareShop;
    	$product = Inventory::with('attachment')->where('shop_id', $shop->id)->find($id);
    	return view('shop.itemDetails', compact('product', 'id'));
    }
}
