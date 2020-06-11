<?php

namespace App\Http\Controllers;

use App\Model\ActionLog;
use Auth;

use App\Model\Order;
use App\Model\User;
use App\Model\Inventory;
use App\Model\Attachment;
use App\Model\InventoryVariant;
use App\Model\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class ShopOwnerController extends Controller
{
    public function index()
    {

        $orderCount = Order::where('shop_id', Auth::user()->owner_shop_id)
            ->whereBetween('created_at', [now()->subDays(30), now()]);
        $customerCount = User::where('customer_shop_id', Auth::user()->owner_shop_id)->count();
        $salesCount = Order::where('shop_id', Auth::user()->owner_shop_id)
            ->whereBetween('created_at', [now()->subDays(30), now()])->sum('total_price');

        return view('shopOwner.index', compact(['orderCount', 'customerCount', 'salesCount']));
    }

    public function editOrder($id)
    {

        $data = Order::find($id);

        return view('shopOwner.editOrder', compact('data', 'id'));
    }

    public function display()
    {
        $products = Inventory::with('attachment')->get();

        return view('shopOwner.product', compact('products'));
    }

    public function list()
    {
        $orders = Order::where('shop_id', Auth::user()->owner_shop_id)
            ->whereBetween('created_at', [now()->subDays(30), now()]);


        return view('shopOwner.order', compact('orders'));
    }

    public function show($id)
    {
        $orderItems = OrderItem::where('order_id', Auth::user()->owner_shop_id);

        $order = Order::find($id);

        // dd($order->billingAddress()->get()->first()->name);

        return view('shopOwner.orderDetails', compact('order', 'orderItems', 'id'));
    }

    public function getAddProduct()
    {
        $defaultImage = Inventory::getDefaultImage();
        return view('/shopOwner/addProduct', compact('defaultImage'));
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAddProduct(Request $request)
    {

        $this->validate($request, [
            'product_name' => 'required',
            'description'  => 'required',
            'price'        => 'required',
            'quantity'     => 'required',
            'dimension'    => 'required',
            'status'       => 'required',
            'variant'      => 'required'
        ]);


        $inventory = new Inventory();

        $inventory->shop_id     = Auth::user()->owner_shop_id;
        $inventory->name        = request('product_name');
        $inventory->description = request('description');
        $inventory->price       = request('price');
        $inventory->quantity    = request('quantity');
        $inventory->status      = request('status');
        $inventory->dimension   = request('dimension');
        $inventory->save();

        foreach (request('variant') as $variant) {
            $inventoryVariant = new InventoryVariant();
            $inventoryVariant->inventory_id = $inventory->id;
            $inventoryVariant->name = $variant;
            $inventoryVariant->save();
        }
        if ($request->hasFile('image-file')) {
            $path = $request->file('image-file')->store('public');
            $attachment = new Attachment();
            $attachment->inventory_id = $inventory->id;
            $attachment->user_id = Auth::user()->id;
            $attachment->shop_id = Auth::user()->owner_shop_id;
            $attachment->type = 'image';
            $attachment->filename = str_replace("public/", "storage/", $path);
            $attachment->save();
        }
        ActionLog::shopAddProduct(Auth::user()->owner_shop_id, Auth::user()->id, $inventory->id);
        return redirect('/product')->with('success', 'New product added');
    }

    public function getProductDetail($id)
    {

        $product = Inventory::with('inventoryVariant')->find($id);
        // dd($product->inventoryVariant()->get());
        return view('shopOwner.productDetails', compact('product', 'id'));
    }

    public function patchProductDetail(Request $request, $id)
    {
        $this->validate($request, [
            'product_name'    => 'required',
            'description'     => 'required',
            'price'           => 'required',
            'quantity'        => 'required',
            'status'          => 'required',
        ]);

        $product = Inventory::find($id);

        $product->name          = $request->get('product_name');
        $product->description   = $request->get('description');
        $product->price         = $request->get('price');
        $product->quantity      = $request->get('quantity');
        $product->status        = $request->get('status');
        $inventoryVariants = InventoryVariant::where([
            ['inventory_id', '=', $id]
        ])->get();
        $inventoryVariants = $inventoryVariants->toArray();
        $product->save();

        foreach (request('variant') as $variant) {
            $key = array_search($variant, array_column($inventoryVariants, 'name'));
            if ($key === false) {
                $inventoryVariant = new InventoryVariant();
                $inventoryVariant->inventory_id = $product->id;
                $inventoryVariant->name = $variant;
                $inventoryVariant->save();
            } else {
                unset($inventoryVariants[$key]);
            }
        }
        foreach ($inventoryVariants as $variantNeedDelete) {
            InventoryVariant::findOrFail($variantNeedDelete['id'])->delete();
        }

        ActionLog::shopUpdateProduct(Auth::user()->owner_shop_id, Auth::user()->id, $product->id);
        return redirect()->route('main-siteproductDetails', [app('request')->route('subdomain') ?? '', $id])->with('success', 'Data updated');
    }

    public function postAddProductImage(Request $request, $id)
    {
        if ($request->hasFile('image-file')) {
            $path = $request->file('image-file')->store('public');
            $attachment = new Attachment();
            $attachment->inventory_id = $id;
            $attachment->user_id = Auth::user()->id;
            $attachment->shop_id = Auth::user()->owner_shop_id;
            $attachment->type = 'image';
            $attachment->filename = str_replace("public/", "storage/", $path);
            $attachment->save();
            return redirect()->route('main-siteproductDetails', [app('request')->route('subdomain') ?? '', $id])->with('success', 'Image has been save');
        }
        return redirect()->route('main-siteproductDetails', [app('request')->route('subdomain') ?? '', $id])->with('error', 'Image is not uploaded');
    }

    public function deleteProductImage(Request $request, $id, $attachmentId)
    {
        $attachment = Attachment::where([
            ['id', '=', $attachmentId],
            ['inventory_id', '=', $id],
            ['shop_id', '=', Auth::user()->owner_shop_id],
        ])->first();
        if ($attachment === null) {
            return redirect()->route('main-siteproductDetails', [app('request')->route('subdomain') ?? '', $id])->with('error', 'Image does not exist');
        }
        $attachment->delete();
        return redirect()->route('main-siteproductDetails', [app('request')->route('subdomain') ?? '', $id])->with('success', 'Image is deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Inventory::find($id);

        $product->delete();

        ActionLog::shopDeleteProduct(Auth::user()->owner_shop_id, Auth::user()->id, $product->id);
        return redirect('/product')->with('success', 'Product Deleted');
    }

    public function UpdateOrderStatus(Request $request, $id)
    {

        $order = Order::find($id);

        $order->status = $request->get('status');
        $order->save();

        return redirect('/order')->with('success', 'Status updated');
    }

    public function getManageAccount()
    {
        $user = Auth::user();

        return view('shopOwner.manageAccount', compact('user'));
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
                'main-sitemanageAccount',
                [app('request')->route('subdomain') ?? '']
            )->with('success', 'Account updated');
    }

    public function getLog()
    {
        $actionLogs = ActionLog::where('shop_id', Auth::user()->owner_shop_id)
            ->orderBy('created_at', 'desc')->get();

        return view('shopOwner.actionLogs', compact('actionLogs'));
    }
}
