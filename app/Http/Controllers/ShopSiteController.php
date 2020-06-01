<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Inventory;
use App\Model\Shop;
use Auth;
use Hash;

class ShopSiteController extends Controller {

    public function index(){

    	$items = Inventory::with('attachment')->get();

        return view('shop.index', compact('items'));
    }

    public function displayDetails($id){

    	$product = Inventory::find($id); 
    	return view('shop.itemDetails', compact('product', 'id'));
    }
}
