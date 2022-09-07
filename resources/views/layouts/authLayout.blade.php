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
<div class="row">
    <div class="col-md-6">
        <img src="img/img.png" style="width: 100%;">
    </div>
    <div class="col-md-6">
        @yield('content')
    </div>
</div>



{{--<div id="app">--}}
{{--    <main>--}}
{{--        @yield('content')--}}
{{--    </main>--}}
{{--</div>--}}
</body>
</html>
