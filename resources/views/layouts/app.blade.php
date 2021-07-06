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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/email.css')}}" />
    <link rel="stylesheet" href="{{asset('css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('css/history.css')}}">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body id="body-pd" class="bg-light">
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <header class="header" id="header">
            <div class="header_toggle">
                <i class="bx bx-menu" id="header-toggle"></i>
            </div>
            <div class="header_img">
                @if(Auth::user()->image==null)
                <img src="{{asset('images/users/dwayne-the-rock-.jpg')}}" alt="" />

                @else
                    <img src="{{asset('images/users/'.Auth::user()->image)}}" alt="" />
                @endif
            </div>
        </header>
        <div>
            <a href="#" class="nav_logo">
                <div class="nav_logo-name">
                    @if(Auth::user()->image==null)
                        <img id="navLogo" class="d-none" src="{{asset('images/users/dwayne-the-rock-.jpg')}}"
                        alt="the rock"/>
                        @else

                            <img id="navLogo" class="d-none" src="{{asset('images/users/'.Auth::user()->image )}}"
                            alt="the rock"/>
                        @endif

                </div>
            </a>
            <div class="nav_list">
                @if (Auth::user()->is_admin ==1)
                <a href="{{url('users-list')}}" class="py-2 nav_link ">
                    <i class="bx bx-grid-alt nav_icon"></i>
                    <span class="nav_name">Users</span>
                </a>
                <a href="settings" class="py-2 nav_link">
                    <i class="bx bx-message-square-detail nav_icon"></i>
                    <span class="nav_name">Settings</span>
                </a>
                <a href="logout" class="nav_link py-2">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name">SignOut</span>
                </a>
               @else
                <a href="{{url('send-emails')}}" class="py-2 nav_link active">
                    <i class="bx bx-grid-alt nav_icon"></i>
                    <span class="nav_name">Email</span>
                </a>
                <a href="{{url('history')}}" class="py-2 nav_link">
                    <i class="bx bx-user nav_icon"></i>
                    <span class="nav_name">History</span>
                </a>
                <a href="settings" class="py-2 nav_link">
                    <i class="bx bx-message-square-detail nav_icon"></i>
                    <span class="nav_name">Settings</span>
                </a>
                <a href="subscription" class="py-2 nav_link">
                    <i class="bx bx-bookmark nav_icon"></i>
                    <span class="nav_name">Subscription</span>
                </a>
                <a href="logout" class="nav_link py-2">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name">SignOut</span>
                </a>
                @endif
            </div>
        </div>
    </nav>
</div>
{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav mr-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ml-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <main class="py-4">--}}
            @yield('content')
{{--        </main>--}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/index.js')}}"></script>
    @livewireScripts
</body>
</html>
