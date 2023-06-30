<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('public/assets/images/smmie_logo.ico') }}" type="image/ico">

    <!-- Styles -->
    <link href="{{ asset('public/assets/bootstrap/bootstrap_5.2.1.min.css') }}" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('public/assets/js/alert/toastr_alert.css') }}">
    {{--    <link href="{{ asset('public/build/assets/app-3ea8b221.css') }}" rel="stylesheet">--}}

    <style>
        .active {
            /*text-decoration: underline;*/
            font-weight: bolder;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong>{{ config('app.name', 'ACTS-Library') }}</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->is('home') ? 'active' : '' }}" href="{{ url('home') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->is('request') ? 'active' : '' }}" href="{{ url('requests') }}">{{ __('Request') }}</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link text-white" href="#">{{ __('History') }}</a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->is('user_details') ? 'active' : '' }}" href="{{ url('user_details') }}">{{ __('User Details') }}</a>
                            </li>
                            @if(Auth::user()->user_type === "admin")

                                <li class="nav-item">
                                    <a class="nav-link text-white {{ request()->is('books') ? 'active' : '' }}" href="{{ url('books') }}">{{ __('Books') }}</a>
                                </li>

                            @endif
                        </ul>
                    @endauth


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white {{ request()->is('users') ? 'active' : '' }} {{ request()->is('profile') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>

                                    @if(Auth::user()->user_type === "admin")
                                        <a class="dropdown-item" href="{{ route('users') }}">{{ __('Users') }}</a>
                                    @endif

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
            @auth()
                {{ checkUserDetails() }}
            @endauth

            @yield('content')
        </main>
    </div>
</body>

<!-- Scripts -->
{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
{{--    <script src="{{ asset('public/js/app.js') }}"></script>--}}
<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/assets/bootstrap/bootstrap.bundle.5.2.1.min.js') }}"></script>
<script src="{{ asset('public/assets/js/alert/toastr_alert.js') }}"></script>

@stack('scripts')

    @if (Session::has('success'))
        <script>
            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{!! Session::get('success') !!}");
        </script>
   @endif

    @if (Session::has('error'))
        <script>
            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{!! Session::get('error') !!}");
        </script>
   @endif

    <script>
        // $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        //     $(".alert").slideUp(500);
        // });
    </script>

</html>
