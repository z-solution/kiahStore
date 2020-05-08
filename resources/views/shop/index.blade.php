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

        <section class="text-center my-5">
          <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
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
                          <a href="" class="grey-text">
                            <h5>Shirt</h5>
                          </a>
                          <h5>
                            <strong>
                              <a href="" class="dark-grey-text">Denim shirt
                                <span class="badge badge-pill badge-danger">NEW</span>
                              </a>
                            </strong>
                          </h5>
                          <h4 class="font-weight-bold blue-text">
                            <strong>120$</strong>
                          </h4>
                        </div>
                        <!-- Card content -->
                    </div>
                  <!-- Card -->
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
                  <!-- Card -->
                    <div class="card align-items-center">
                        <!-- Card image -->
                        <div class="view overlay">
                          <img src="{{ asset('img/grey.jpg') }}" class="card-img-top" alt="">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>
                        <!-- Card image -->
                        <!-- Card content -->
                        <div class="card-body text-center">
                          <!-- Category & Title -->
                          <a href="" class="grey-text">
                            <h5>Sport wear</h5>
                          </a>
                          <h5>
                            <strong>
                              <a href="" class="dark-grey-text">Sweatshirt</a>
                            </strong>
                          </h5>
                          <h4 class="font-weight-bold blue-text">
                            <strong>139$</strong>
                          </h4>
                        </div>
                        <!-- Card content -->
                    </div>
                  <!-- Card -->
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-lg-3 col-md-6 mb-md-0 mb-4">
                  <!-- Card -->
                    <div class="card align-items-center">
                        <!-- Card image -->
                        <div class="view overlay">
                          <img src="{{ asset('img/red.jpg') }}" class="card-img-top" alt="">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>
                        <!-- Card image -->
                        <!-- Card content -->
                        <div class="card-body text-center">
                          <!-- Category & Title -->
                          <a href="" class="grey-text">
                            <h5>Sport wear</h5>
                          </a>
                          <h5>
                            <strong>
                              <a href="" class="dark-grey-text">Grey blouse
                                <span class="badge badge-pill badge-primary">BEST</span>
                              </a>
                            </strong>
                          </h5>
                          <h4 class="font-weight-bold blue-text">
                            <strong>99$</strong>
                          </h4>
                        </div>
                        <!-- Card content -->
                    </div>
                   <!-- Card -->
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-lg-3 col-md-6">
                  <!-- Card -->
                    <div class="card align-items-center">
                        <!-- Card image -->
                        <div class="view overlay">
                          <img src="{{ asset('img/coat.jpg') }}" class="card-img-top" alt="">
                          <a>
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>
                        <!-- Card image -->
                        <!-- Card content -->
                        <div class="card-body text-center">
                          <!-- Category & Title -->
                          <a href="" class="grey-text">
                            <h5>Outwear</h5>
                          </a>
                          <h5>
                            <strong>
                              <a href="" class="dark-grey-text">Black jacket</a>
                            </strong>
                          </h5>
                          <h4 class="font-weight-bold blue-text">
                            <strong>219$</strong>
                          </h4>
                        </div>
                        <!-- Card content -->
                    </div>
                    <!-- Card -->
                </div>
                <!-- Grid column -->
            </div>
          <!-- Grid row -->
        </section>
    </div>
@endsection 

