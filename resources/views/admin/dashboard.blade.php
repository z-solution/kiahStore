@extends('layouts.adminLayout')

@section('content')
<div class="container">
  <div class="card-deck mb-4">
    <div class="card">
      <div class="card-header text-center">
        <b>Total admin</b>
      </div>
      <div class="card-body text-center">
        <h4 class="card-text">{{ $adminCount }}</h4>
      </div>
    </div>
    <div class="card">
      <div class="card-header text-center">
        <b>Total Shop Owners</b>
      </div>
      <div class="card-body text-center">
        <h4 class="card-text">{{ $shopOwnerCount }}</h4>
      </div>
    </div>
    <div class="card">
      <div class="card-header text-center">
        <b>Total Customer</b>
      </div>
      <div class="card-body text-center">
        <h4 class="card-text">{{ $customerCount }}</h4>
      </div>
    </div>
  </div>
</div>
@endsection