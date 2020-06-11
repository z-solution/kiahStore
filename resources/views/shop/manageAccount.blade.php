@extends('layouts.shopLayout')

@section('content')
<div class="container product-list">
    @if(\Session::has('success'))
    <div class="alert alert-success">
        <p>{{\Session::get('success') }}</p>
    </div>
    @endif
    <form id="logout-form" action="{{ route('shop-sitepostManageAccount', app('request')->route('subdomain') ?? '') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="user-name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter the name" value="{{ $user->name }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="user-email">Email</label>
            <div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="user-password">Password</label>
            <div>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" autocomplete="new-password">
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

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