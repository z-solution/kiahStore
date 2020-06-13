@extends('layouts.mainSiteLayout')

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
        <div class="card-deck mt-4">
          <div class="card">
            <img class="card-img-top" src="{{ asset('img/easy-to-use.jpg') }}"  alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title font-weight-bold">Easy to use</h4>
              <p class="card-text">Kiah store is design to be easy to use. With focus for the small business.</p>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('img/fast-approval.jpg') }}"  alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title font-weight-bold">Fast Approval</h4>
              <p class="card-text">The approve process is fast and easy. Suitable for business without to much hassle to apply.</p>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('img/made-in-malaysia.jpg') }}"  alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title font-weight-bold">Made in Malaysia</h4>
              <p class="card-text">Kiahstore is proud to be made in Malaysia. It was design for Malaysia culture.</p>
            </div>
          </div>
        </div>
    </div>
@endsection 

