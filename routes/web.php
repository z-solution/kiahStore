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
        Route::get('/', 'Auth\AdminLoginController@adminLoginForm')->name('login');
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->middleware('adminAuth')->name('dashboard');

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

        Route::get('/home', function () {
            return view('/shopOwner/index');
        })->name('home')->middleware('shopOwnerAuth');

        Route::get('/product', function () {
            return view('/shopOwner/product');
        })->name('product')->middleware('shopOwnerAuth');

        Route::get('/order', function () {
            return view('/shopOwner/order');
        })->name('order')->middleware('shopOwnerAuth');

        Route::get('/coupon', function () {
            return view('/shopOwner/coupon');
        })->name('coupon')->middleware('shopOwnerAuth');

        Route::get('/productDetails', function () {
            return view('/shopOwner/productDetails');
        })->name('productDetails')->middleware('shopOwnerAuth');

        Route::get('/orderDetails', function () {
            return view('/shopOwner/orderDetails');
        })->name('orderDetails')->middleware('shopOwnerAuth');

        Route::get('/couponCRUD', function () {
            return view('/shopOwner/couponCRUD');
        })->name('couponCRUD')->middleware('shopOwnerAuth');

        Route::get('/addProduct', function () {
            return view('/shopOwner/addProduct');
        })->name('addProduct')->middleware('shopOwnerAuth');

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
        Route::get('/', function () {
            return view('/shop/index');
        });
        Route::get('/customerSignUp', function () {
            return view('/shop/customerSignUp');
        });
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
