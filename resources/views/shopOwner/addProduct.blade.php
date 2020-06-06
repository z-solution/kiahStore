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
                            <label for="myFile">Product Image</label><br>
                            <img id="product-image" src="{{ $defaultImage }}">
                            <input type="file" id="myFile" name="image-file">
                        </div>

                        <div class="form-group">
                            <label for="user-name">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                name="product_name" placeholder="Product name">
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user-email">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" placeholder="Description">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user-email">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                placeholder="Enter the price">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user-email">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                name="quantity" placeholder="Enter the quantity">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user-email">Dimension</label>
                            <input type="string" class="form-control @error('dimension') is-invalid @enderror"
                                name="dimension" placeholder="Enter the dimension. e.g. 100x100x100">
                            @error('dimension')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product">Product Status:</label>
                            <select class="form-control" name="status">
                                <option value="1">Available</option>
                                <option value="0">Out of Stock</option>
                                <option value="2">Pending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product">Product Variant:</label><br>
                            <ul id="add-variant-list">
                                @if(old('variant'))
                                    @foreach(old('variant') as $variant)
                                        <li>{{ $variant }}  <div class="remove-btn"> Remove</div><input type="hidden" name="variant[]" value="{{ $variant }}">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <input type="text" id="add-variant"
                                class="form-control @error('variant') is-invalid @enderror"
                                placeholder="Enter the variant. e.g. White XXL">
                            @error('variant')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div id="add-variant-btn" class="btn btn-outline-info">Add</div>
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

        $('#add-variant-btn').click(() => {
            let data = $('#add-variant').val();
            $('#add-variant-list').append(
                `<li>${data} <div class="remove-btn"> Remove</div><input type="hidden" name="variant[]" value="${data}"></li>`
            )
            $('#add-variant').val('');
        })
        $('#add-variant-list').on('click', '.remove-btn', (ele) => {
          $(ele.currentTarget).parent().remove();
        })
    });

</script>
@endsection
