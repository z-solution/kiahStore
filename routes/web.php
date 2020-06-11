<?php

use Illuminate\Support\Facades\Route;

use App\Model\Shop;
use App\Model\System;
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
        Route::get('/shop-owner/{id}', 'AdminSiteController@getShowOwnerEdit')->middleware('adminAuth')->name('shop-ownerEdit');
        Route::post('/shop-owner/{id}', 'AdminSiteController@postShowOwnerEdit')->middleware('adminAuth')->name('postShopOwnerEdit');
        Route::get('/customer', 'AdminSiteController@getCustomer')->middleware('adminAuth')->name('customer');
        Route::get('/customer/{id}', 'AdminSiteController@getcustomerEdit')->middleware('adminAuth')->name('customerEdit');
        Route::post('/customer/{id}', 'AdminSiteController@postcustomerEdit')->middleware('adminAuth')->name('postCustomerEdit');
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

        Route::get('/productDetails/{id}', 'ShopOwnerController@getProductDetail')->middleware('shopOwnerAuth')->name('productDetails');

        Route::patch('/productDetails/{id}', 'ShopOwnerController@patchProductDetail')->middleware('shopOwnerAuth')->name('productDetails');

        Route::post('/productDetails/{id}/upload-image', 'ShopOwnerController@postAddProductImage')->middleware('shopOwnerAuth')->name('productUploadImage');

        Route::delete('/productDetails/{id}/image/{attachmentId}', 'ShopOwnerController@deleteProductImage')->middleware('shopOwnerAuth')->name('deleteProductImage');

        Route::get('/addProduct', 'ShopOwnerController@getAddProduct')->middleware('shopOwnerAuth')->name('addProduct');

        Route::post('/addProduct', 'ShopOwnerController@postAddProduct')->middleware('shopOwnerAuth')->name('addProduct');

        Route::delete('/product/{id}', 'ShopOwnerController@destroy')->middleware('shopOwnerAuth')->name('deleteProduct');

        Route::get('/order', 'ShopOwnerController@list')->middleware('shopOwnerAuth')->name('order');

        Route::get('/orderEdit/{id}', 'ShopOwnerController@editOrder')->middleware('shopOwnerAuth')->name('orderEdit');

        Route::patch('/orderEdit/{id}', 'ShopOwnerController@UpdateOrderStatus')->middleware('shopOwnerAuth')->name('orderEdit');

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
    function ($request) {
        // Shop frontend
        Route::get('/', 'ShopSiteController@index')->name('index');
        Route::get('/item-details/{id}', 'ShopSiteController@displayDetails')->name('itemDetails');
        Route::get('/cart', 'ShopSiteController@getCart')->middleware('customerAuth')->name('cart');
        Route::post('/add-to-cart', 'ShopSiteController@postAddToCart')->name('addToCart');
        Route::post('/remove-cart-item', 'ShopSiteController@postRemoveCartItem')->name('removeCartItem');
        Route::get('/checkout', 'ShopSiteController@getCheckout')->middleware('customerAuth')->name('checkout');
        Route::post('/checkout-confirm', 'ShopSiteController@postCheckoutConfirm')->middleware('customerAuth')->name('checkoutConfirm');
        Route::post('/add-coupon', 'ShopSiteController@postAddCoupon')->middleware('customerAuth')->name('addCoupon');
        Route::delete('/add-coupon', 'ShopSiteController@postDeleteCoupon')->middleware('customerAuth')->name('deleteCoupon');
        Route::get('/manage-order', 'ShopSiteController@getManageOrder')->middleware('customerAuth')->name('manageOrder');
        Route::get('/manage-order/{id}/cancel', 'ShopSiteController@getManageOrderCancel')->middleware('customerAuth')->name('manageOrderCancel');
        Route::get('/manage-order/{id}/refund', 'ShopSiteController@getManageOrderRefund')->middleware('customerAuth')->name('manageOrderRefund');
        Route::get('/manage-order/{id}/track', 'ShopSiteController@getManageOrderTrack')->middleware('customerAuth')->name('manageOrderTrack');
        Route::get('/profile', function () {
            return 'Customer profile';
        })->middleware('customerAuth')->name('customerProfile');

        Route::get('/product-list', 'ShopSiteController@getProductList')->name('productList');
        
        Route::get('/fake-payment-mockup', 'ShopSiteController@getMockupPayment')->middleware('customerAuth')->name('paymentMockSite');
        Route::post('/fake-payment-mockup', 'ShopSiteController@postMockupPayment')->middleware('customerAuth')->name('postPaymentMockSite');
      
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
