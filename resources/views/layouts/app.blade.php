<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laragram</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <h1><a class="navbar-brand" href="{{ url('/') }}">
                    Laragram
                </a></h1>

                <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-link"><a href="{{ route('home') }}">Home</a></li>
                            <li class="nav-link"><a href="{{ route('user.index') }}">Search</a></li>
                            <li class="nav-link"><a href="{{ route('new.image') }}">Upload Image</a></li>
                            <li class="nav-link">
                                <a href="{{route('user.profile', ['id' => \Auth::user()->id])}}" role="button">
                                    @if(Auth::user()->image) 
                                    <img src="{{url('/user/image/'.Auth::user()->image)}}" class="profile-image"/>
                                    @endif
                                    {{ Auth::user()->fullname }} <span class="caret"></span>
                                </a>
                            </li>

                        @endguest
                    </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
