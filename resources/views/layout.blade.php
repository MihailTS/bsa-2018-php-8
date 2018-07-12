
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
<nav>
    <div class="nav-wrapper blue-grey">
        <ul id="nav-mobile" class="left">
            <li><a href="{{route('currencies.index')}}">Currencies</a></li>
            <li><a href="{{route('currencies.create')}}">Add</a></li>
        </ul>
    </div>
</nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
