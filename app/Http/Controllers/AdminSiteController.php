<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\User;
use Illuminate\Http\Request;
use App\shopOwner;
use Hash;

class AdminSiteController extends Controller
{
    public function getDashboard()
    {
        $adminCount = User::countAdmin();
        $shopOwnerCount = User::countShopOwner();
        $customerCount = User::countCustomer();
        return view('admin.dashboard', compact(['adminCount', 'shopOwnerCount', 'customerCount']));
    }

    public function getShowOwner()
    {
        $shopOwners = Shop::all();
        $shopStatus = Shop::STATUS;
        return view('admin.shopOwner', compact('shopOwners', 'shopStatus'));
    }

    public function postApprove(Request $request, $subdomain, $id)
    {
        $shop = Shop::find($id);
        $shop->status = Shop::STATUS['Approve'];
        $shop->save();

        return redirect('/shop-owner')->with('success', 'Shop has been approve');
    }
}
