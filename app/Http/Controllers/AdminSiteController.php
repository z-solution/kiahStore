<?php

namespace App\Http\Controllers;

use App\Model\ActionLog;
use App\Model\Shop;
use App\Model\System;
use App\Model\User;
use Illuminate\Http\Request;

use Auth;

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

    public function getShowOwnerEdit(Request $request, $www, $id)
    {
        $shop = Shop::where('id', intval($id))->first();
        return view('admin.shopOwnerEdit', compact('shop'));
    }

    public function postShowOwnerEdit(Request $request, $www, $id)
    {
        $this->validate($request, [
            'shopName' => 'required',
            'email' => ['required', 'string', 'email'],
            'name' => 'required',
        ]);
        $shop = Shop::where('id', intval($id))->first();
        $shop->name = $request->input('shopName');
        $owner = $shop->userAsShopOwner()->first();
        $owner->email = $request->input('email');
        $owner->name = $request->input('name');
        $shop->save();
        $owner->save();
        return redirect()
            ->route(
                'main-admin-siteshop-ownerEdit',
                [app('request')->route('subdomain') ?? '', $id]
            )->with('success', 'Shop has been updated');
    }

    public function postApprove(Request $request, $subdomain, $id)
    {
        $admin = Auth::user();
        Shop::approveShop($id);
        ActionLog::shopApprove($id, $admin->id);
        return redirect('/shop-owner')->with('success', 'Shop has been approved');
    }

    public function getCustomer()
    {
        $customers = User::getCustomer();
        return view('admin.customer', compact('customers'));
    }

    public function getCustomerEdit(Request $request, $www, $id)
    {
        $customer = User::where('id', intval($id))->first();
        return view('admin.customerEdit', compact('customer'));
    }

    public function postCustomerEdit(Request $request, $www, $id)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'name' => 'required',
        ]);
        $customer = User::where('id', intval($id))->first();
        $customer->email = $request->input('email');
        $customer->name = $request->input('name');
        $customer->save();
        return redirect()
            ->route(
                'main-admin-sitecustomerEdit',
                [app('request')->route('subdomain') ?? '', $id]
            )->with('success', 'Customer has been updated');
    }

    public function getSetting()
    {
        $shopMaintainerMood = System::where('name', System::SYSTEMSHOPMAINTAINERMOOD)->first();
        $systemShopMaintainerMood = System::SYSTEMSHOPMAINTAINERMOOD;
        return view('admin.setting', compact('shopMaintainerMood', 'systemShopMaintainerMood'));
    }

    public function postSetting(Request $request)
    {
        $system = System::where('name', request('name'))->first();
        if ($system == null) {
            $system = new System();
            $system->name = request('name');
        }
        $system->value = request('value');
        $system->save();
        return redirect('/setting')->with('success', request('desc_name') . ' has been ' . request('desc_value'));
    }
}
