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
        // Route::get('/login', function () {
        //     return "shop owner login";
        // });
        Route::get('/shopOwnerSignUp', 'MainSiteController@signUp')->name('shopOwnerSignUp');
        Route::post('/shopOwnerSignUp', 'MainSiteController@store');
        // Route::get('/signUp', function() {
        //     return view('signUp');
        // });

        Route::get('/dashboard', function () {
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
        Route::get('/customerSignUp', function(){
            return view('/shop/customerSignUp');
        });

        // Route::post('/customerSignUp', 'ShopController@store');

        Route::get('/login', function () {
            return "customer login";
        });
    }
);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
