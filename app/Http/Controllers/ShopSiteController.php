<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Cart;
use App\Model\CartItem;
use App\Model\Coupon;
use App\Model\Inventory;
use App\Model\Order;
use App\Model\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

use Auth;

class ShopSiteController extends Controller
{

    public function index(Request $request)
    {
        $shop = $request->middlewareShop;
        $items = Inventory::with('attachment',)->where('shop_id', $shop->id)->get();

        return view('shop.index', compact('items'));
    }

    public function displayDetails(Request $request, $id)
    {
        $shop = $request->middlewareShop;
        $product = Inventory::with('attachment', 'inventoryVariant')->where('shop_id', $shop->id)->find($id);
        return view('shop.itemDetails', compact('product', 'id'));
    }

    public function getCart(Request $request)
    {
        $shop = $request->middlewareShop;
        $user = Auth::user();
        $cart = Cart::where([
            ['user_id', '=', $user->id],
            ['shop_id', '=', $shop->id]
        ])->first();
        $cartItems = [];
        if (!!$cart) {
            $cartItems = $cart->cartItems()->get();
        }
        return view('shop.cart', compact('user', 'cart', 'cartItems'));
    }

    public function postAddToCart(Request $request)
    {
        $this->validate($request, [
            'quantity'    => 'required',
            'product-id'  => 'required',
            'variant-id'  => 'required'
        ]);
        $user = Auth::user();
        $shop = $request->middlewareShop;
        $quantity = $request->input('quantity');
        $quantityInCart = 0;
        $variantAlreadyKey = -1;
        $product = Inventory::find($request->input('product-id'));
        $cart = Cart::where([
            ['user_id', '=', $user->id],
            ['shop_id', '=', $shop->id]
        ])->first();
        if ($cart == null) {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->shop_id = $shop->id;
            $cart->save();
        }
        $cartItems = $cart->cartItems()->get();
        $cartItems = $cartItems->toArray();
        // get quantity of the product. 
        $keys = array_keys(array_column($cartItems, 'inventory_id'), $product->id);
        foreach ($keys as $key) {
            if ($cartItems[$key]['inventory_variant_id'] != $request->input('variant-id')) {
                $quantityInCart += $cartItems[$key]['quantity'];
            } else {
                $variantAlreadyKey = $key;
            }
        }
        //check if got enough quantity
        if ($product->quantity - $quantity - $quantityInCart < 0) {
            return redirect()
                ->route(
                    'shop-siteitemDetails',
                    [$product->id]
                )->with('error', 'Product quantity is not enough');
        }
        if ($variantAlreadyKey !== -1) {
            $cartItem = CartItem::find($cartItems[$variantAlreadyKey]['id']);
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return redirect()
                ->route(
                    'shop-siteitemDetails',
                    [$product->id]
                )->with('success', 'Cart item has been updated');
        } else {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->inventory_variant_id = $request->input('variant-id');
            $cartItem->inventory_id = $product->id;
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return redirect()
                ->route(
                    'shop-siteitemDetails',
                    [$product->id]
                )->with('success', 'Product added into inventory');
        }
    }

    public function getCheckout(Request $request)
    {
        $shop = $request->middlewareShop;
        $user = Auth::user();
        $cart = Cart::where([
            ['user_id', '=', $user->id],
            ['shop_id', '=', $shop->id]
        ])->first();
        $cartItems = $cart->cartItems()->get();
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->inventory()->first()->price * $item->quantity;
        }
        $coupon = $cart->coupon()->first();
        if ($coupon) {
            $totalPrice -= $coupon->value;
        }
        return view('shop.checkout', compact('user', 'cart', 'cartItems', 'totalPrice', 'coupon'));
    }

    public function postRemoveCartItem(Request $request)
    {
        $cartItem = CartItem::find($request->input('cartItemId'));
        $cartItem->delete();
        return redirect()
            ->route(
                'shop-sitecart'
            )->with('success', 'Item has been remove from cart');
    }

    public function postCheckoutConfirm(Request $request)
    {
        $this->validate($request, [
            'billing-name' => 'required',
            'billing-street1' => 'required',
            'billing-street2' => 'required',
            'billing-city' => 'required',
            'billing-state' => 'required',
            'billing-zcode' => 'required',
            'billing-country' => 'required',
            'shipping-name' => 'required',
            'shipping-street1' => 'required',
            'shipping-street2' => 'required',
            'shipping-city' => 'required',
            'shipping-state' => 'required',
            'shipping-zcode' => 'required',
            'shipping-country' => 'required',
        ]);
        $shop = $request->middlewareShop;
        $user = Auth::user();
        $cart = Cart::where([
            ['user_id', '=', $user->id],
            ['shop_id', '=', $shop->id]
        ])->first();
        $cartItems = $cart->cartItems()->get();
        $coupon = $cart->coupon()->first();
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->inventory()->first()->price * $item->quantity;
        }
        if ($coupon) {
            $totalPrice -= $coupon->value;
        }
        $order = new Order();
        $order->user_id = $user->id;
        $order->shop_id = $shop->id;
        $order->status = Order::UNPAID;
        $order->total_price = $totalPrice;
        $order->billing_address_id = 0;
        $order->shipping_address_id = 0;
        $order->save();
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->inventory_variant_id = $item->inventory_variant_id;
            $orderItem->price = $item->inventory()->first()->price;
            $orderItem->quantity = $item->quantity;
            $orderItem->save();
        }
        $billingAddress = new Address();
        $billingAddress->order_id = $order->id;
        $billingAddress->name = $request->input("billing-name");
        $billingAddress->street_address1 = $request->input("billing-street1");
        $billingAddress->street_address2 = $request->input("billing-street2");
        $billingAddress->city = $request->input("billing-city");
        $billingAddress->state = $request->input("billing-state");
        $billingAddress->zip_code = $request->input("billing-zcode");
        $billingAddress->country = $request->input("billing-country");
        $billingAddress->save();
        $shippingAddress = new Address();
        $shippingAddress->order_id = $order->id;
        $shippingAddress->name = $request->input("shipping-name");
        $shippingAddress->street_address1 = $request->input("shipping-street1");
        $shippingAddress->street_address2 = $request->input("shipping-street2");
        $shippingAddress->city = $request->input("shipping-city");
        $shippingAddress->state = $request->input("shipping-state");
        $shippingAddress->zip_code = $request->input("shipping-zcode");
        $shippingAddress->country = $request->input("shipping-country");
        $shippingAddress->save();
        $order->billing_address_id = $billingAddress->id;
        $order->shipping_address_id = $shippingAddress->id;
        $order->save();
        //Redirect to mockup payment site.

        $cart->delete();
        foreach ($cartItems as $item) {
            $item->delete();
        }
        return redirect()
            ->route(
                'shop-sitepaymentMockSite',
                ["orderId" => $order->id]
            );
    }

    public function getMockupPayment(Request $request)
    {

        $shop = $request->middlewareShop;
        $orderId = $request->input('orderId');
        return view('shop.paymentMockup', compact('orderId'));
    }

    public function postMockupPayment(Request $request)
    {
        $shop = $request->middlewareShop;
        $orderId = $request->input('orderId');
        $status = $request->input('success');
        $order = Order::find($orderId);
        if ($status == '1') {
            $order->status = Order::PAID;
            foreach ($order->orderItem()->get() as $item) {
                $inventory = $item->inventoryVariant()->first()->inventory()->first();
                $inventory->quantity -= $item->quantity;
                $inventory->save();
            }
        } else if ($status == '0') {
            $order->status = Order::PAIDFAIL;
        }
        $order->save();
        return redirect()
            ->route('shop-siteindex');
    }

    public function getManageOrder(Request $request)
    {
        $shop = $request->middlewareShop;
        $orders = Auth::user()->orders()->get();
        $orderStatus = Order::STATUSNAME;
        return view('shop.order', compact('orders', 'orderStatus'));
    }

    public function getManageOrderCancel(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = Order::CANCEL;
        $order->save();
        return redirect()
            ->route(
                'shop-sitemanageOrder'
            )->with('success', 'Order has been cancel');
    }

    public function getManageOrderRefund(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = Order::REFUNDREQUEST;
        $order->save();
        return redirect()
            ->route(
                'shop-sitemanageOrder'
            )->with('success', 'Order has been cancel');
    }

    public function getManageOrderTrack(Request $request, $id)
    {
        return "Show where order is";
    }

    public function postAddCoupon(Request $request)
    {
        $user = Auth::user();
        $shop = $request->middlewareShop;
        $cartId = $request->input('cartId');
        $cart = Cart::find($cartId);
        $couponCode = $request->input('coupon');
        $coupon = Coupon::where([
            ['shop_id', '=', $shop->id],
            ['code', '=', $couponCode]
        ])->first();
        if ($coupon == null) {

            return redirect()
                ->route(
                    'shop-sitecheckout'
                )->with('error', 'Coupon not valid');
        }
        $cart->coupon_id = $coupon->id;
        $cart->save();
        return redirect()
            ->route(
                'shop-sitecheckout'
            )->with('success', 'Coupon added');
    }

    public function postDeleteCoupon(Request $request)
    {
        $user = Auth::user();
        $shop = $request->middlewareShop;
        $cartId = $request->input('cartId');
        $cart = Cart::find($cartId);
        $cart->coupon_id = 0;
        $cart->save();
        return redirect()
            ->route(
                'shop-sitecheckout'
            )->with('success', 'Coupon remove');
    }

    public function getProductList(Request $request)
    {

        $shop = $request->middlewareShop;
        $q = $request->input('q');
        $sort = $request->input('sort') ?: 'nameasc';
        $itemsq = Inventory::with('attachment')
            ->where([
                ['shop_id', '=', $shop->id],
                ['name', 'like', '%' . $q . '%']
            ]);
        if ($sort == 'nameasc') {
            $itemsq->orderBy('name', 'asc');
        }
        if ($sort == 'namedesc') {
            $itemsq->orderBy('name', 'desc');
        }
        if ($sort == 'priceasc') {
            $itemsq->orderBy('price', 'asc');
        }
        if ($sort == 'pricedesc') {
            $itemsq->orderBy('price', 'desc');
        }
        $items = $itemsq->get();
        return view('shop.productList', compact('q', 'items', 'sort'));
    }

    public function getManageAccount()
    {
        $user = Auth::user();

        return view('shop.manageAccount', compact('user'));
    }


    public function postManageAccount(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);
        $user = Auth::user();
        $name = $request->input('name');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        $user->name = $name;
        if ($password != '') {
            if ($password != $password_confirmation) {
                throw ValidationException::withMessages(['password' => 'This value is incorrect']);
            }
            $user->password = Hash::make($password);
        }
        $user->save();
        return redirect()
            ->route(
                'shop-sitemanageAccount'
            )->with('success', 'Account updated');
    }
}
