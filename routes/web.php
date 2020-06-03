<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|-------------------------------------
| Main Site Admin Route Group
|-------------------------------------
|
| This will group all the main site admin. Login, manage user 
| and manage system.
|
*/

Route::group(
    [
        'domain' => '{subdomain}.' . config('app.domain'),
        'as' => 'main-admin-site',
        'where' => [
            'subdomain' => 'admin'
        ],
    ],
    function () {
        Route::get('/', 'Auth\AdminLoginController@getAdminLoginForm')->name('login');
        Route::get('/dashboard', 'AdminSiteController@getDashboard')->middleware('adminAuth')->name('dashboard');
        Route::get('/shop-owner', 'AdminSiteController@getShowOwner')->middleware('adminAuth')->name('shop-owner');
        Route::post('/shop-owner/{id}/approve', 'AdminSiteController@postApprove')->middleware('adminAuth')->name('shop-owner-approve');
        Route::get('/customer', 'AdminSiteController@getCustomer')->middleware('adminAuth')->name('customer');
        Route::get('/setting', 'AdminSiteController@getSetting')->middleware('adminAuth')->name('setting');
        Route::post('/post', 'AdminSiteController@postSetting')->middleware('adminAuth')->name('post-setting');


        // Authentication Routes...
        Route::post('/', 'Auth\AdminLoginController@login');
        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');
    }
);


/*
|-------------------------------------
| Main Site Route Group
|-------------------------------------
|
| This will group all the main site. Non-www and WWW subdomain. 
| Login, registeration, and all blog,feature willbe here
|
*/

Route::group(
    [
        'domain' => '{subdomain}' . config('app.domain'),
        'as' => 'main-site',
        'where' => [
            'subdomain' => 'www.|'
        ],
    ],
    function () {
        Route::get('/', function () {
            return view('welcome');
        });

    
        Route::get('/home', 'ShopOwnerController@index')->middleware('shopOwnerAuth')->name('home');
        
        Route::get('/product', 'ShopOwnerController@display')->middleware('shopOwnerAuth')->name('product');

        Route::get('/addProduct', function () {
            return view('/shopOwner/addProduct');
        })->name('addProduct')->middleware('shopOwnerAuth');

        Route::post('/addProduct', 'ShopOwnerController@store')->middleware('shopOwnerAuth')->name('addProduct');

        Route::delete('/product/{id}', 'ShopOwnerController@destroy')->middleware('shopOwnerAuth')->name('deleteProduct');

        Route::get('/productDetails/{id}', 'ShopOwnerController@edit')->middleware('shopOwnerAuth')->name('productDetails');

        Route::patch('/productDetails/{id}', 'ShopOwnerController@update')->middleware('shopOwnerAuth')->name('productDetails');



        Route::get('/order', 'ShopOwnerController@list')->middleware('shopOwnerAuth')->name('order');

        Route::get('/orderDetails/{id}', 'ShopOwnerController@show')->middleware('shopOwnerAuth')->name('orderDetails');



        Route::get('/coupon', 'CouponController@index')->middleware('shopOwnerAuth')->name('coupon');

        Route::get('/createCoupon', function () {
            return view('/shopOwner/createCoupon');
        })->middleware('shopOwnerAuth')->name('createCoupon');

        Route::post('/createCoupon', 'CouponController@store')->middleware('shopOwnerAuth')->name('createCoupon');


        Route::get('/couponCRUD/{id}', 'CouponController@edit')->middleware('shopOwnerAuth')->name('couponCRUD');

        Route::patch('/couponCRUD/{id}', 'CouponController@update')->middleware('shopOwnerAuth')->name('couponCRUD');
        

        // Authentication Routes...
        Route::get('login', 'Auth\ShopOwnerLoginController@showShopOwnerLoginForm')->name('login');
        Route::post('login', 'Auth\ShopOwnerLoginController@login');
        Route::post('logout', 'Auth\ShopOwnerLoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('/register', 'Auth\ShopOwnerRegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'Auth\ShopOwnerRegisterController@register');
    }
);

/*
|-------------------------------------
| Shop Site Route Group
|-------------------------------------
|
| This will group all the shop site. Visitor login to customer,
| browser product, buy product
|
*/

Route::group(
    [
        'middleware' => 'shopSite',
        'as' => 'shop-site'
    ],
    function () {
        // Shop frontend
        Route::get('/', 'ShopSiteController@index')->name('index');
        Route::get('/itemDetails/{id}', 'ShopSiteController@displayDetails')->name('itemDetails');

        Route::get('/profile', function () {
            return 'Customer profile';
        })->name('customerProfile')->middleware('customerAuth');


        Route::get('login', 'Auth\CustomerLoginController@customerLoginForm')->name('login');
        Route::post('login', 'Auth\CustomerLoginController@login');
        Route::post('logout', 'Auth\CustomerLoginController@logout')->name('logout');

        Route::get('/register', 'Auth\CustomerRegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'Auth\CustomerRegisterController@register');
    }
);
/*
|-------------------------------------
| Shop Site Route Group for Not Approve and Maintainer Mood
|-------------------------------------
|
| This will used as a based for shop when the shop still not approve or in maintainer mood.
|
*/

Route::group(
    [
        'middleware' => 'shopSiteNotApproved',
        'as' => 'shop-site'
    ],
    function () {
        Route::get('/{any}', function () {
            return 'no shop 404';
        })->where('any', '.*');
    }
);
