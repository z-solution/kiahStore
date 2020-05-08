@extends('layouts.app')

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
            <ol class="carousel-indicators">
                <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                  <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(88).jpg" width="100">
                </li>
                <li data-target="#carousel-thumb" data-slide-to="1">
                  <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(121).jpg" width="100">
                </li>
                <li data-target="#carousel-thumb" data-slide-to="2">
                  <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(31).jpg" width="100">
                </li>
            </ol>
        </div>
        <!--/.Carousel Wrapper-->
        <div class="card-deck mt-4">
          <div class="card">
            <img class="card-img-top" src="{{ asset('img/f1.jpg') }}"  alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title font-weight-bold">Feature 1</h4>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('img/f2.jpg') }}"  alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title font-weight-bold">Feature 2</h4>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content. just added extra text to make it the paragraph a bit longer and at the same time keep them all aligned.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="{{ asset('img/f3.png') }}"  alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title font-weight-bold">Feature 3</h4>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
    </div>
@endsection 

