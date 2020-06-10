@extends('layouts.shopLayout')
@section('content')
<div class="container cart">
    @if(\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
    @endif
    @if(\Session::has('error'))
    <div class="alert alert-danger">
        <p>{{ \Session::get('error') }}</p>
    </div>
    @endif
    <div class="card">
        <h2>Cart</h2>
        <h5>Items</h5>

        @if(count($cartItems))
    
        <ul class="cart-list">
            @foreach($cartItems as $item)
            <li class="cart-item-list">
                <div style="display: inline-block; height: 70px; width:70px;">
                    <img class="cart-inventory-image" src="{{$item->inventory()->first()->getFirstAttachmentFilename()}}" alt="">
                </div>
                <div style="display: inline-block;">
                    {{$item->inventory()->first()->name}} ( {{$item->inventoryVariant()->first()->name}} )
                    <br>
                    Quantity: {{$item->quantity}}
                    <br>
                    price: MYR {{ number_format($item->inventory()->first()->price, 2, '.', ',')}}

                    <form method="POST" action="{{ route('shop-siteremoveCartItem', app('request')->route('subdomain') ?? '') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="cartItemId" value="{{ $item->id }}">
                        <button type="submit" class="remove-btn">x</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        <a href="{{ route('shop-sitecheckout', app('request')->route('subdomain') ?? '') }}">
            <div class="btn btn-primary">Checkout</div>
        </a>

        @else
        They cart is empty
        @endif
    </div>
</div>
<!--container.//-->
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
<script>
</script>
@endsection