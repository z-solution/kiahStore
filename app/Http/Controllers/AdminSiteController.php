<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\System;
use App\Model\User;
use Illuminate\Http\Request;

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

    
    public function getSetting()
    {
        $shopMaintainerMood = System::where('name', System::SYSTEMSHOPMAINTAINERMOOD)->first();
        return view('admin.setting', compact( 'shopMaintainerMood'));
    }
    public function postSetting(Request $request)
    {
        $system = System::where('name', request('name'))->first();
        if($system == null) {
            $system = new System();
            $system->name = request('name');
        }
        $system->value = request('value');
        $system->save();
        return redirect('/setting')->with('success', request('desc_name') . ' has been ' . request('desc_value'));
    }
}
