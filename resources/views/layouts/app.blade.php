<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Save Money</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('scriptSrc')
</head>
<body>
<div class="row" style="height: 100%">
    <div class="col-md-3" style="padding-right: 0">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="navbar navbar-light bg-white">
                <ul class="navbar-nav justify-content-end flex-grow-1 ps-4">
                    <li class="nav-item active">
                        <a href="{{route('dashboard.index')}}"><img src="{{ URL::to('/') }}/img/img_1.png" style="width: 32px"/></a>
                    </li>
                    <li class="nav-item active">
                        <a href="{{route('dashboard.index')}}"><img src="{{ URL::to('/') }}/img/img_2.png" style="width: 79px"/></a>
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
                    <a class="nav-link" href="{{route('dashboard.index')}}">B???ng tin<span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route(('CategoryIncome.index'))}}">Qu???n l?? lo???i kho???n thu <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route(('CategoryExpense.index'))}}">Qu???n l?? lo???i kho???n chi <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('income.index') }}">Qu???n l?? kho???n thu <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('expense.index') }}">Qu???n l?? kho???n chi <span class="sr-only"></span></a>
                </li>

                <li class="nav-item active">
{{--                    <a class="nav-link" href="{{route('report-month')}}">Qu???n l?? b??o c??o <span class="sr-only"></span></a>--}}

                    <a class="dropdown-toggle nav-link" href="{{route('report-month')}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Qu???n l?? b??o c??o
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{route('report-week')}}">B??o c??o tu???n</a>
                        <a class="dropdown-item" href="{{route('report-month')}}">B??o c??o th??ng</a>
                    </div>
                </li>



                <li>
                    <hr class="table-group-divider" style="width: 150%">
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('user.index')}}">Th??ng tin t??i kho???n <span class="sr-only"></span></a>
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
                                        <button class="btn btn-outline-secondary">{{ __('????ng xu???t') }}</button>
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
        <!-- Modal create-->
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
        <!-- Modal edit-->
        <div class="modal fade" style="padding-right: 0!important; z-index: 10000" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            @yield('modalEdit')
                            <div class="modal-footer border border-white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal delete-->
        <div class="modal fade" style="padding-right: 0!important; z-index: 10000" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            @yield('modalDelete')
                            <div class="modal-footer border border-white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal index-->
        <div class="modal fade" style="padding-right: 0!important;" id="modalIndex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            @yield('modalIndex')
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
    @yield('script')
</html>
