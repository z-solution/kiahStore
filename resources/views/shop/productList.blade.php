@extends('layouts.shopLayout')

@section('content')
<div class="container product-list">
    <form id="logout-form" action="{{ route('shop-siteproductList', app('request')->route('subdomain') ?? '') }}" method="get">
        <input type="hidden" name="q" value="{{$q}}">
        <label for="">Sort</label>
        <select name="sort" onchange="this.form.submit();">
            <option value="nameasc" @if($sort == "nameasc") selected @endif>Name Ascending</option>
            <option value="namedesc" @if($sort == "namedesc") selected @endif>Name Descending</option>
            <option value="priceasc" @if($sort == "priceasc") selected @endif>Price Ascending</option>
            <option value="pricedesc" @if($sort == "pricedesc") selected @endif>Price Descending</option>
        </select>
    </form>
    <div class="row">
        @foreach($items as $item)
        <!-- Grid column -->
        <a href="{{route('shop-siteitemDetails',[$item->id ])}}">
            <div class="col-lg-3 col-md-6 mb-2">
                <!-- Card -->
                <div class="card align-items-center">
                    <!-- Card image -->
                    <div class="view overlay">
                        <img src="{{ $item->getFirstAttachmentFilename() }}" class="product-image card-img-top" alt="">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <!-- Card image -->
                    <!-- Card content -->
                    <div class="card-body text-center">
                        <h5>
                            <strong>
                                <a href="{{route('shop-siteitemDetails',[$item->id ])}}" class="dark-grey-text">
                                    {{$item->name}}
                                    {{--<span class="badge badge-pill badge-danger">NEW</span>--}}
                                </a>
                            </strong>
                        </h5>
                        <h4 class="font-weight-bold blue-text">
                            <strong>RM {{$item->price}}</strong>
                        </h4>
                    </div>
                    <!-- Card content -->
                </div>
                <!-- Card -->
            </div>
        </a>
        <!-- Grid column -->
        @endforeach
    </div>
</div>
<!--container.//-->
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>
<script>
    $(document).ready(function() {});
</script>
@endsection