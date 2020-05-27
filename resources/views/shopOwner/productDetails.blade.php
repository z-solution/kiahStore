@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <!-- <div class="card-header bg-secondary text-light">Product details Page</div> -->
                <div class="card-body">
                    <form method="POST" action="{{route('main-siteproductDetails', app('request')->route('subdomain') ?? '')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PATCH" />
                        
                        <div class="form-group mb-4">
                            <img src="#" class="rounded mx-auto d-block" id="product-image" />
                        </div>
                         <div class="form-group">
                            <label for="user-name">Product Name</label>
                            <input type="text" class="form-control" name="product_name" value="">
                          </div>
                          <div class="form-group">
                            <label for="user-email">Description</label>
                            <input type="text" class="form-control" name="description" value="">
                          </div>
                          <div class="form-group">
                            <label for="user-email">Price</label>
                            <input type="number" class="form-control" name="price" value="">
                          </div>
                          <div class="form-group">
                            <label for="user-email">Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="">
                          </div>
                          <div class="form-group">
                            <label for="user-email">Status</label>
                            <input type="number" class="form-control" name="status" value="">
                          </div>
                          <!-- <div class="form-group">
                            <label for="user-password">SKU</label>
                            <input type="number" class="form-control" name="sku" value="">
                          </div> -->
                          <button type="submit" class="btn btn-primary"> Save </button>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection


