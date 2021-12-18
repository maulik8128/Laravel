<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title> @yield('title', 'Home') | {{ config('app.name', 'Laravel') }} </title>

    <!-- Scripts -->
    <script src="{{ asset('assets/jquery/jquery-3.6.0.min.js') }}"></script>
    {{--  <script src="{{ asset('js/app.js') }}" defer></script>  --}}
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/table_custome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />

    @yield('assets')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Route::has('category.index'))
                                <li class="navbar-brand {{ (request()->segment(1) == 'category') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('category.index') }}">{{ __('Category') }}</a>
                                </li>
                            @endif
                            @if (Route::has('product.index'))
                                <li class="navbar-brand {{ (request()->segment(1) == 'product') ? 'active' : '' }} ">
                                    <a class="nav-link" href="{{ route('product.index') }}">{{ __('Product') }}</a>
                                </li>
                            @endif
                            @if (Route::has('location'))
                                <li class="navbar-brand {{ (request()->segment(1) == 'location') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('location') }}">{{ __('Location') }}</a>
                                </li>
                            @endif
                            @if (Route::has('user.index'))
                                <li class="navbar-brand {{ (request()->segment(1) == 'user') ? 'active' : '' }} ">
                                    <a class="nav-link" href="{{ route('user.index') }}">{{ __('User') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
</body>
<footer>
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin_validation.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
@yield('footerAsset')
</footer>
</html>
