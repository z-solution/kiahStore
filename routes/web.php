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


        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showShopOwnerLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('/register', 'Auth\ShopOwnerRegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'Auth\ShopOwnerRegisterController@register');

        // // Password Reset Routes...
        // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        // Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        Route::get('/home', 'HomeController@index')->name('home');
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

        Route::get('login', 'Auth\LoginController@customerOwnerLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('/register', function () {
            return 'shop register get';
        })->name('register');
        Route::post('/register', function () {
            return 'shop register get';
        });
    }
);
