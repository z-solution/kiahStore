<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body class="login-body">
  <div class="login-container">
    <div class="title">
      <span>Admin Login</span>
    </div>

    <form method="POST" action="{{ route('main-admin-sitelogin', app('request')->route('subdomain') ?? '') }}">
    @csrf
      <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      <div class="submit-container">
        <button type="submit" class="btn btn-primary">
          {{ __('Login') }}
        </button>
      </div>
    </form>
  </div>
  <!-- Footer -->
  @yield('scripts')
</body>

</html>