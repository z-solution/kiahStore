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
            return view('admin2.index');
        });
        Route::get('/dashboard', function () {
            return 'Admin Dashboard';
        });

        // Authentication Routes...
        Route::get('login', 'Auth\AdminLoginController@AdminOwnerLoginForm')->name('login');
        Route::post('login', 'Auth\AdminLoginController@login');
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
            return view('/admin/index');
        });
        Route::get('/product', function(){
            return view('/admin/product');
        });
        Route::get('/order', function () {
            return view('/admin/order');
        });

        Route::get('/coupon', function () {
            return view('/admin/coupon');
        });

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
        Route::get('/customerSignUp', function () {
            return view('/shop/customerSignUp');
        });

        Route::get('login', 'Auth\CustomerLoginController@customerLoginForm')->name('login');
        Route::post('login', 'Auth\CustomerLoginController@login');
        Route::post('logout', 'Auth\CustomerLoginController@logout')->name('logout');

        Route::get('/register', 'Auth\CustomerRegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'Auth\CustomerRegisterController@register');
    }
);
