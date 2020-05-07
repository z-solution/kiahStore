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
            return "this will be an admin site";
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
        Route::get('/signUp', 'MainSiteController@signUp')->name('signUp');
        Route::post('/signUp', 'MainSiteController@store');
        // Route::get('/signUp', function() {
        //     return view('signUp');
        // });
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
            return 'This will be the shop';
        });
        Route::get('/login', function () {
            return "customer login";
        });
    }
);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
