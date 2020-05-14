@extends('layouts.shopOwnerLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <!-- <div class="card-header bg-secondary text-light">Product details Page</div> -->
                <div class="card-body">
                    <form method="POST" action="/customerSignUp" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group mb-4">
                            <img src="#" class="rounded mx-auto d-block" style="width: 60px; height: 60px;" />
                        </div>
                         <div class="form-group">
                            <label for="user-name">Product Name</label>
                            <input type="text" class="form-control" name="product_name" placeholder="Product name">
                          </div>
                          <div class="form-group">
                            <label for="user-email">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Description">
                          </div>
                          <div class="form-group">
                            <label for="user-email">Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Enter the price">
                          </div>
                          <div class="form-group">
                            <label for="user-email">Quantity</label>
                            <input type="number" class="form-control" name="quantity" placeholder="Enter the quantity">
                          </div>
                          <div class="form-group">
                            <label for="user-password">SKU</label>
                            <input type="number" class="form-control" name="sku" placeholder="SKU">
                          </div>
                          <button type="submit" class="btn btn-primary"> Save </button>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection


