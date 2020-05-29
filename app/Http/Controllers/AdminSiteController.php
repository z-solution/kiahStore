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
        Shop::approveShop($id);
        return redirect('/shop-owner')->with('success', 'Shop has been approved');
    }

    
    public function getCustomer()
    {
        $customers = User::getCustomer();
        return view('admin.customer', compact('customers'));
    }
}
