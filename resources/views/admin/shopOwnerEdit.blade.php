@extends('layouts.adminLayout')

@section('content')
<div class="container shop-owner">

  @if(\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success') }}</p>
  </div>
  @endif

  @if(\Session::has('error'))
  <div class="alert alert-danger">
    <p>{{\Session::get('error') }}</p>
  </div>
  @endif
  
  <form method="POST" action="{{ route('main-admin-sitepostShopOwnerEdit', [app('request')->route('subdomain') ?? '', $shop->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
  <label for="shopName">Shop Name</label>
  <input type="text" class="form-control @error('shopName') is-invalid @enderror" name="shopName" id="shopName" placeholder="Enter the shop name" value="{{ $shop->name }}" required autofocus>
  @error('shopName')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror

  
  <label for="email">Email</label>
  <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter the Email" value="{{ $shop->userAsShopOwner()->first()->email }}" required autofocus>
  @error('email')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror

  <label for="name">Name</label>
  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter the name" value="{{ $shop->userAsShopOwner()->first()->name }}" required autofocus>
  @error('name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror

  <br>
  <button type="submit" class="btn btn-primary confirm-btn">Confirm</button>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
<script>
</script>
@endsection