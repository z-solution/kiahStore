@extends('layouts.shopLayout')

@section('content')
    <div class="container">
        @if(\Session::has('success'))
            <div class="alert alert-success">
               <p>{{\Session::get('success') }}</p>
            </div>
        @endif
        <!--Carousel Wrapper-->
        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ asset('img/1.jpg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('img/2.jpg') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('img/3.jpeg') }}"alt="Third slide">
                </div>
            </div>
            <!--/.Slides-->
            <!--Controls-->
              <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            <!--/.Controls-->
        </div>
        <!--/.Carousel Wrapper-->

        <section class="text-center my-5">
          <!-- Grid row -->
            
              <div class="row">
                @foreach($items as $item)
                  <!-- Grid column -->
                  <a href="{{route('shop-siteitemDetails',[$item->id ])}}">
                    <div class="col-lg-3 col-md-6 mb-lg-0 mb-2">
                      <!-- Card -->
                        <div class="card align-items-center">
                            <!-- Card image -->
                            <div class="view overlay">
                              <img src="{{ asset('img/blue.jpg') }}" class="card-img-top" alt="">
                              <a>
                                <div class="mask rgba-white-slight"></div>
                              </a>
                            </div>
                            <!-- Card image -->
                            <!-- Card content -->
                            <div class="card-body text-center">
                              <!-- Category & Title -->
                              {{-- <a href="{{route('shop-siteitemDetails',[$item->id ])}}" class="grey-text">
                                <h5>Shirt</h5>
                              </a> --}}
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
          <!-- Grid row -->
        </section>
    </div>
@endsection 

