<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kiah Store</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="shop-site navbar-top navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #800000">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"> Kiah Store </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <form id="query" action="{{ route('shop-siteproductList', app('request')->route('subdomain') ?? '') }}" method="get">
                    <input type="text" placeholder="Search term" name="q" class="search-input">
                    <button>Search</button>
                </form>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop-sitelogin') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('shop-siteregister'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop-siteregister') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a href="{{ route('shop-sitecart', app('request')->route('subdomain') ?? '') }}" class="user-navbar-btn user-cart"><i class="fa fa-shopping-cart"></i> Cart</a>
                            <a id="navbarDropdown" class="user-navbar-btn nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('shop-sitemanageOrder', app('request')->route('subdomain') ?? '') }}">
                                    {{ __('Manage Order') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('shop-sitemanageAccount', app('request')->route('subdomain') ?? '') }}">
                                    {{ __('Manage Account') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('shop-sitelogout', app('request')->route('subdomain') ?? '') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('shop-sitelogout', app('request')->route('subdomain') ?? '') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Footer -->
    <div class="footer-placeholder">

    </div>
    <footer class="page-footer font-small">
        <div class="footer-copyright text-center py-3">
            © 2020 Copyright
        </div>
    </footer>
    @yield('scripts')
</body>

</html>