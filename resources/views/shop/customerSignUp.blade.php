@extends('layouts.shopLayout')

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-light">Customer Sign Up Page</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                       
                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                               <p>{{\Session::get('success') }}</p>
                            </div>
                        @endif
                        <form method="POST" action="/customerSignUp" enctype="multipart/form-data">
                            {{csrf_field()}}
                             <div class="form-group">
                                <label for="user-name">Customer Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter the name">
                              </div>
                              <div class="form-group">
                                <label for="user-email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email">
                              </div>
                              <div class="form-group">
                                <label for="user-email">Phone Number</label>
                                <input type="number" class="form-control" name="phone" placeholder="Enter phone number">
                              </div>
                              <div class="form-group">
                                <label for="user-email">Address</label>
                                <input type="number" class="form-control" name="address" placeholder="Enter your address">
                              </div>
                              <div class="form-group">
                                <label for="user-password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password">
                              </div>
                              <div class="form-group">
                                <label for="user-password">Confirm password</label>
                                <input type="password" class="form-control" name="confirm-password" placeholder="Confirm password">
                              </div>
                              
                              <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection 

