<?php

namespace App\Http\Controllers;

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
        return view('admin.shopOwner');
    }


}
