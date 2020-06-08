@extends('layouts.shopLayout')

@section('content')
<div class="container item-detail">

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
        <div class="row">
            <aside class="col-sm-5 border-right">
                <article class="gallery-wrap">
                    <div class="img-big-wrap">
                        <div>
                            <img id="product-image-main-display" src="{{ $product->getFirstAttachmentFilename() }}">
                        </div>
                    </div> <!-- slider-product.// -->
                    <div class="img-small-wrap">
                        @forelse ($product->attachment as $attachment)
                        <div class="item-gallery">
                            <img class="product-image" src="/{{ $attachment->filename }}">
                        </div>
                        @empty
                        <div class="item-gallery">
                            <img class="product-image" src="{{ $product->getFirstAttachmentFilename() }}">
                        </div>
                        @endforelse
                    </div> <!-- slider-nav.// -->
                </article> <!-- gallery-wrap .end// -->
            </aside>
            <aside class="col-sm-7">
                <article class="card-body p-5">

                    <form method="POST" action="{{ route('shop-siteaddToCart', app('request')->route('subdomain') ?? '') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="product-id" value="{{ $product->id }}">
                        <h3 class="title mb-3">{{ $product->name }}</h3>
                        <p class="price-detail-wrap">
                            <span class="price h3 text-primary">
                                <span class="currency">MYR </span><span class="num">{{ $product->price }}</span>
                            </span>
                        </p> <!-- price-detail-wrap .// -->
                        <dl class="item-property">
                            <dt>Description</dt>
                            <dd>
                                <p>{{ $product->description }} </p>
                            </dd>
                        </dl>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4 mr-4">
                                <label>Quantity:</label> <span class="quantity-left @if($product->quantity <= 5) limited @endif"> Left {{ $product->quantity }} item(s) </span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="btn btn-dark btn-sm" id="minus-btn"><i class="fa fa-minus"></i>
                                        </div>
                                    </div>
                                    <input type="number" id="qty_input" class="form-control form-control-sm" value="1" min="1">
                                    <input type="hidden" name="quantity" id="qty_input_submit">
                                    <div class="input-group-prepend">
                                        <div class="btn btn-dark btn-sm" id="plus-btn" data-limit="{{ $product->quantity }}"><i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <dl class="param param-inline">
                                    <dt class="mb-2">Variants:</dt>
                                    <select name="variant-id" id="">
                                        @foreach($product->inventoryVariant as $variant)
                                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                        @endforeach
                                    </select>
                                </dl> <!-- item-property .// -->
                            </div> <!-- col.// -->
                        </div> <!-- row.// -->
                        <hr>

                        @guest
                        <span>Please login to make a purchase</span>
                        @else
                        {{-- <a href="#" class="btn btn-lg btn-primary text-uppercase"> Buy now </a> --}}
                        <button class="btn btn-lg btn-outline-primary text-uppercase">Add to cart</button>
                        @endguest
                    </form>
                </article> <!-- card-body.// -->
            </aside> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- card.// -->
</div>
<!--container.//-->
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#plus-btn').click(function() {
            let quantity = parseInt($('#qty_input').val());
            let quantitiyMax = +$('#plus-btn').attr('data-limit')
            if (quantity < quantitiyMax) {
                $('#qty_input').val(quantity + 1);
                $('#qty_input_submit').val($('#qty_input').val());
            }
        });
        $('#minus-btn').click(function() {
            if ($('#qty_input').val() > 1) {
                $('#qty_input').val(parseInt($('#qty_input').val()) - 1);
            }
        });
        $('.product-image').click((ele, a, b) => {
            $('#product-image-main-display').attr('src', $(ele.currentTarget).attr('src'));
        })
        $('#qty_input_submit').val($('#qty_input').val());
    });
</script>
@endsection