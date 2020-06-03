@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header bg-secondary text-light">Create Coupon</div>
                <div class="card-body">
                    <form method="POST" action="{{route('main-sitecreateCoupon', app('request')->route('subdomain') ?? '')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        
                        <div class="form-group">
                          <label for="coupon-code">Coupon Code</label>
                          <input type="text" class="form-control" name="coupon_code" placeholder="Enter the coupon code">
                        </div>  
                        <div class="form-group">
                          <label for="coupon-value">Coupon Value</label>
                          <input type="number" class="form-control" name="coupon_value" placeholder="Enter the coupon value">
                        </div>   
                        <div class="form-group" inline="true">
                          <label for="expiry-date">Expiration Date</label>
                            <input type="date" placeholder="Select expiration date" name="expiry_date" class="form-control">
                        </div> 

                          <button type="submit" class="btn btn-primary float-right"> Submit </button>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection



