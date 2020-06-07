@extends('layouts.shopOwnerLayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                <!-- <div class="card-header bg-secondary text-light">Product details Page</div> -->
                <div class="card-body">
                    <div class="form-group mb-4">
                        <h3>
                            Product Detail Page
                        </h3>
                    </div>
                    @foreach($product->attachment as $attachment)
                        <div class="delete-image-container">
                            <form id="delete-product-image{{ $attachment->id }}" method="POST"
                                action="{{ route('main-sitedeleteProductImage',[ app('request')->route('subdomain') ?? '', $product->id, $attachment->id]) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <div class="delete-image-text"
                                    onclick="document.forms['delete-product-image{{ $attachment->id }}'].submit();">
                                    Delete</div>
                            </form>
                            <img src="/{{ $attachment->filename }}" class="rounded d-inline-block"
                                id="product-image" />
                        </div>
                    @endforeach
                    <form method="POST"
                        action="{{ route('main-siteproductUploadImage',[ app('request')->route('subdomain') ?? '', $product->id ]) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="upload-image" class="btn">
                            <div class="btn btn-info"> Add Image </div>
                        </label>
                        <input type='file' id="upload-image" name="image-file" onchange="this.form.submit();"
                            style="visibility: hidden;" />
                    </form>
                    <form method="POST"
                        action="{{ route('main-siteproductDetails',[ app('request')->route('subdomain') ?? '', $product->id ]) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="form-group">
                            <label for="user-name">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                name="product_name" value="{{ $product->name }}">
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user-email">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ $product->description }}">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user-email">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                value="{{ $product->price }}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user-email">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                name="quantity" value="{{ $product->quantity }}">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product">Product Status:</label>
                            <select class="form-control" name="status">
                                <option value="1" @if($product->status == 1) selected @endif> Available</option>
                                <option value="0" @if($product->status == 0) selected @endif>Out of Stock</option>
                                <option value="2" @if($product->status == 2) selected @endif>Pending</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product">Product Variant:</label><br>
                            <ul id="add-variant-list">
                                @foreach($product->inventoryVariant()->get() as $variant)
                                    <li>{{ $variant->name }} <div class="remove-btn"> Remove</div><input type="hidden"
                                            name="variant[]" value="{{ $variant->name }}">
                                    </li>
                                @endforeach
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
                        <!-- @foreach($product->inventoryVariant()->get() as $test)
                            <div>
                                asd<br>
                                {{ $test->toJson() }}
                            </div>
                        @endforeach -->
                        <!-- <div class="form-group">
                            <label for="user-password">SKU</label>
                            <input type="number" class="form-control" name="sku" value="">
                          </div> -->
                        <button type="submit" class="btn btn-primary float-right"> Save </button>
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
