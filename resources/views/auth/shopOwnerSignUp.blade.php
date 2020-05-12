@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-secondary text-light">Shop Owner Sign Up Page</div>
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
            <form method="POST" action="/register" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <label for="user-name">Shop Owner Name</label>
                <div>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter the name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="user-email">Email</label>
                <div>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="user-password">Password</label>
                <div>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required autocomplete="new-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="user-password">Confirm password</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
              </div>
              <div class="form-group">
                <label for="user-password">Store Name</label>
                <div>
                  <div class="input-group @error('shopName') is-invalid @enderror">
                    <input type="text" class="form-control  @error('shopName') is-invalid @enderror" name="shopName" placeholder="Enter Store Name password" value="{{ old('shopName') }}">
                    <div class="input-group-prepend">
                      <div class="input-group-text">.kiahStore.com</div>
                    </div>
                  </div>

                  @error('shopName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
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