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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Save Money</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{--                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">--}}
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Quản lý loại khoản thu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Quản lý loại khoản chi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Quản lý khoản thu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Quản lý khoản chi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Quản lý báo cáo
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                                <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                                {{--                                    <li>--}}
                                {{--                                        <hr class="dropdown-divider">--}}
                                {{--                                    </li>--}}
                                {{--                                    <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
                            </ul>
                        </li>
                        <li>
                            <hr class="divider">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Thông tin tài khoản</a>
                        </li>
                    </ul>
                    {{--                        <form class="d-flex" role="search">--}}
                    {{--                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
                    {{--                            <button class="btn btn-success" type="submit">Search</button>--}}
                    {{--                        </form>--}}
                </div>
            </div>
        </div>
    </nav>




    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            {{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
            {{--                    {{ config('app.name', 'Laravel') }}--}}
            {{--                </a>--}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Quản lý loại khoản thu <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Quản lý loại khoản chi <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Quản lý khoản thu <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Quản lý khoản chi <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Quản lý báo cáo <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Thông tin tài khoản <span class="sr-only"></span></a>
                    </li>

                    {{--                        @foreach($currentgroupMenus as $groupMenu)--}}
                    <li class="nav-item dropdown">
                        {{--                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                        {{--                                    {{$groupMenu->name}}--}}
                        {{--                                </a>--}}
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{--                                    @foreach($currentlinks as $currentlink)--}}
                            {{--                                        @if($currentlink->groupMenu == $groupMenu)--}}
                            {{--                                            <a class="dropdown-item" href="{{route($currentlink->href)}}">{{$currentlink->note}}</a>--}}
                            {{--                                        @else--}}
                            {{--                                        @endif--}}
                            {{--                                    @endforeach--}}
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    {{--                        @endforeach--}}
                </ul>

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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
</html>
