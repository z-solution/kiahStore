<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use App\Model\CartItem;
use App\Model\Inventory;
use Illuminate\Http\Request;

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
        $keys = array_keys(array_column($cartItems, 'product_id'), $product->id);
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
            $cartItem->product_id = $product->id;
            $cartItem->quantity = $quantity;
            $cartItem->save();
            return redirect()
                ->route(
                    'shop-siteitemDetails',
                    [$product->id]
                )->with('success', 'Product added into inventory');
        }
    }
}
