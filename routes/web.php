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
        Route::get('/', function () {
            return "admin page ";
        });
        
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
        })->name('home');

        Route::get('/product', function(){
            return view('/shopOwner/product');
        })->name('product');

        Route::get('/order', function () {
            return view('/shopOwner/order');
        })->name('order');

        Route::get('/coupon', function () {
            return view('/shopOwner/coupon');
        })->name('coupon');

        Route::get('/productDetails', function () {
            return view('/shopOwner/productDetails');
        })->name('productDetails');

        Route::get('/orderDetails', function () {
            return view('/shopOwner/orderDetails');
        })->name('orderDetails');

        Route::get('/couponCRUD', function () {
            return view('/shopOwner/couponCRUD');
        })->name('couponCRUD');

        Route::get('/addProduct', function () {
            return view('/shopOwner/addProduct');
        })->name('addProduct');

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
        'middleware' => 'shop-site',
        'as' => 'shop-site'
    ],
    function () {
        // Shop frontend
        Route::get('/', function () {
            return view('/shop/index');
        });

        Route::get('/productDetails', function () {
            return view('/shop/productDetails');
        });
        

        Route::get('login', 'Auth\CustomerLoginController@customerOwnerLoginForm')->name('login');
        Route::post('login', 'Auth\CustomerLoginController@login');
        Route::post('logout', 'Auth\CustomerLoginController@logout')->name('logout');

        Route::get('/register', 'Auth\CustomerRegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'Auth\CustomerRegisterController@register');
    }
);
