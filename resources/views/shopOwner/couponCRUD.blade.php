@extends('layouts.shopOwnerLayout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-secondary text-light">Edit Coupon</div>
        <div class="card-body">
          <form method="POST" action="{{route('main-sitecouponCRUD', [ app('request')->route('subdomain') ?? '', $coupon->id ] )}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH" />

            <div class="form-group">
              <label for="coupon-code">Coupon Code</label>
              <input type="text" class="form-control" name="coupon_code" value="{{$coupon->code}}">
            </div>
            <div class="form-group">
              <label for="coupon-value">Coupon Value</label>
              <input type="number" class="form-control" name="coupon_value" value="{{$coupon->value}}">
            </div>
            <button type="submit" class="btn btn-primary float-right"> Submit </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection