@extends('layouts.shopLayout')
@section('content')
<div class="container checkout">
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
        <form method="POST" action="{{ route('shop-sitecheckoutConfirm', app('request')->route('subdomain') ?? '') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h2>Checkout</h2>
            <h5>Summary</h5>
            <table>
                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        Price
                    </td>
                    <td>
                        Quantity
                    </td>
                    <td>
                        Total
                    </td>
                </tr>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        {{$item->inventory()->first()->name}} ( {{$item->inventoryVariant()->first()->name}} )
                    </td>
                    <td> MYR {{ number_format($item->inventory()->first()->price, 2, '.', ',')}}
                    </td>
                    <td>
                        {{$item->quantity}}
                    </td>
                    <td>
                        MYR {{ number_format($item->inventory()->first()->price * $item->quantity, 2, '.', ',') }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">Item Total Price</td>
                    <td> MYR {{ number_format($totalPrice, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3">Shipping</td>
                    <td> MYR {{ number_format(0, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td colspan="3">Grand Total</td>
                    <td> MYR {{ number_format($totalPrice, 2, '.', ',') }}</td>
                </tr>
            </table>
            <h4> Billing Address </h4>
            <div class="billing-address">
                <label for="billing-name">Name</label>
                <input type="text" class="form-control @error('billing-name') is-invalid @enderror" name="billing-name" id="billing-name" placeholder="Enter the name" value="{{ old('name') }}" required autofocus>
                @error('billing-name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="billing-street1">Street Address 1</label>
                <input type="text" class="form-control @error('billing-street1') is-invalid @enderror" name="billing-street1" id="billing-street1" placeholder="Enter the street address" value="{{ old('street1') }}" required>
                @error('billing-street1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="billing-street2">Street Address 2</label>
                <input type="text" class="form-control @error('billing-street2') is-invalid @enderror" name="billing-street2" id="billing-street2" placeholder="Enter the street address 2" value="{{ old('street2') }}" required>
                @error('billing-street2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="billing-city">City</label>
                <input type="text" class="form-control @error('billing-city') is-invalid @enderror" name="billing-city" id="billing-city" placeholder="Enter the city" value="{{ old('city') }}" required>
                @error('billing-city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="billing-state">State</label>
                <input type="text" class="form-control @error('billing-state') is-invalid @enderror" name="billing-state" id="billing-state" placeholder="Enter the state" value="{{ old('state') }}" required>
                @error('billing-state')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="billing-zcode">Zip Code</label>
                <input type="text" class="form-control @error('billing-zcode') is-invalid @enderror" name="billing-zcode" id="billing-zcode" placeholder="Enter the zip code" value="{{ old('zcode') }}" required>
                @error('billing-zcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="billing-country">Country</label>
                <input type="text" class="form-control @error('billing-country') is-invalid @enderror" name="billing-country" id="billing-country" placeholder="Enter the country" value="{{ old('country') }}" required>
                @error('billing-country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <h4> Shipping Address </h4>
            <div class="shipping-address">
                <label for="shipping-name">Name</label>
                <input type="text" class="form-control @error('shipping-name') is-invalid @enderror" name="shipping-name" id="shipping-name" placeholder="Enter the name" value="{{ old('name') }}" required autofocus>
                @error('shipping-name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="shipping-street1">Street Address 1</label>
                <input type="text" class="form-control @error('shipping-street1') is-invalid @enderror" name="shipping-street1" id="shipping-street1" placeholder="Enter the street address" value="{{ old('street1') }}" required>
                @error('shipping-street1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="shipping-street2">Street Address 2</label>
                <input type="text" class="form-control @error('shipping-street2') is-invalid @enderror" name="shipping-street2" id="shipping-street2" placeholder="Enter the street address 2" value="{{ old('street2') }}" required>
                @error('shipping-street2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="shipping-city">City</label>
                <input type="text" class="form-control @error('shipping-city') is-invalid @enderror" name="shipping-city" id="shipping-city" placeholder="Enter the city" value="{{ old('city') }}" required>
                @error('shipping-city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="shipping-state">State</label>
                <input type="text" class="form-control @error('shipping-state') is-invalid @enderror" name="shipping-state" id="shipping-state" placeholder="Enter the state" value="{{ old('state') }}" required>
                @error('shipping-state')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="shipping-zcode">Zip Code</label>
                <input type="text" class="form-control @error('shipping-zcode') is-invalid @enderror" name="shipping-zcode" id="shipping-zcode" placeholder="Enter the zip code" value="{{ old('zcode') }}" required>
                @error('shipping-zcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="shipping-country">Country</label>
                <input type="text" class="form-control @error('shipping-country') is-invalid @enderror" name="shipping-country" id="shipping-country" placeholder="Enter the country" value="{{ old('country') }}" required>
                @error('shipping-country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <br>

            <button type="submit" class="confirm-btn">Confirm</button>
        </form>

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