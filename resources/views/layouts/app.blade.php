{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--    <!-- Scripts -->--}}
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
{{--</head>--}}
{{--<body>--}}
{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-dark bg-dark fixed-top">--}}
{{--            <div class="container-fluid">--}}
{{--                <a class="navbar-brand" href="#">Save Money</a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}
{{--                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">--}}
{{--                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">--}}
{{--                    <div class="offcanvas-header">--}}
{{--                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>--}}
{{--                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="offcanvas-body">--}}
{{--                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" aria-current="page" href="#">Home</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Quản lý loại khoản thu</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Quản lý loại khoản chi</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Quản lý khoản thu</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="#">Quản lý khoản chi</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                    Quản lý báo cáo--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu dropdown-menu-dark">--}}
{{--                                    <li><a class="dropdown-item" href="#">Báo cáo</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Báo cáo</a></li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <hr class="divider">--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" href="#">Thông tin tài khoản</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <form class="d-flex" role="search">--}}
{{--                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--                            <button class="btn btn-success" type="submit">Search</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}




{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav me-auto">--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="/">Home <span class="sr-only"></span></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="/">Quản lý loại khoản thu <span class="sr-only"></span></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="/">Quản lý loại khoản chi <span class="sr-only"></span></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="/">Quản lý khoản thu <span class="sr-only"></span></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="/">Quản lý khoản chi <span class="sr-only"></span></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="/">Quản lý báo cáo <span class="sr-only"></span></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="/">Thông tin tài khoản <span class="sr-only"></span></a>--}}
{{--                        </li>--}}

{{--                        @foreach($currentgroupMenus as $groupMenu)--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    {{$groupMenu->name}}--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                    @foreach($currentlinks as $currentlink)--}}
{{--                                        @if($currentlink->groupMenu == $groupMenu)--}}
{{--                                            <a class="dropdown-item" href="{{route($currentlink->href)}}">{{$currentlink->note}}</a>--}}
{{--                                        @else--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                    <div class="dropdown-divider"></div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
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
{{--            @yield('content')--}}
{{--        </main>--}}
{{--    </div>--}}
{{--</body>--}}
{{--</html>--}}

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="row" style="height: 100%">
    <div class="col-md-3" style="padding-right: 0">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="navbar navbar-light bg-white">
                <ul class="navbar-nav justify-content-end flex-grow-1 ps-4">
                    <li class="nav-item active">
                        <img src="{{ URL::to('/') }}/img/img_1.png" style="width: 32px"/>
                    </li>
                    <li class="nav-item active">
                        <img src="{{ URL::to('/') }}/img/img_2.png" style="width: 79px"/>
                    </li>
                    <li>
                        <hr class="table-group-divider" style="width: 150%">
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-light bg-white shadow-sm" style="height: 100vh">
            <ul class="navbar-nav justify-content-end flex-grow-1 ps-4" style="position: absolute;top:30px">
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
{{--                    <a class="nav-link" href="{{route('report-month')}}">Quản lý báo cáo <span class="sr-only"></span></a>--}}
                </li>
                <li>
                    <hr class="table-group-divider" style="width: 150%">
                </li>
                <li class="nav-item active">
{{--                    <a class="nav-link" href="{{route('user.index')}}">Thông tin tài khoản <span class="sr-only"></span></a>--}}
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-md-9" style="padding-left: 2px">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
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
                                <li class="nav-item">
                                    <a class="nav-link">
                                        {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <button class="btn btn-outline-secondary">{{ __('Đăng xuất') }}</button>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <main>
            @yield('content')
        </main>
        <!-- Modal -->
        <div class="modal fade" style="padding-right: 0!important;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="margin-right: 0;margin-top:0;margin-bottom: 0">

                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <div class="modal-content" style="height: 100vh">
                            <div class="modal-header border border-white">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @yield('modalBody')
                            <div class="modal-footer border border-white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })
        </script>
    </div>
</div>
</body>
</html>
