@extends('layouts.shopOwnerLayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-light">Add New Product</div>
                <div class="card-body">
                    <form method="POST"
                        action="{{ route('main-siteaddProduct', app('request')->route('subdomain') ?? '') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

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
                            <label for="user-email">Dimension</label>
                            <input type="string" class="form-control" name="dimension"
                                placeholder="Enter the dimension">
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="product">Product Status:</label>
                                <select class="form-control" name="status">
                                    <option value="1">Available</option>
                                    <option value="0">Out of Stock</option>
                                    <option value="2">Pending</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <img id="product-image" src="{{ $defaultImage }}">
                                <input type="file" id="myFile" name="image-file">
                            </div>

                            <button type="submit" class="btn btn-primary float-right"> Submit </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#product-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#myFile").change(function () {
            readURL(this);
        });
    });

</script>
@endsection
