<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GameList</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    </head>
    <body style = "background-color: #B8DBD9;">
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col text-center title">
                    <h1 class="mb-0" style = "font-family:Impact">
                        <span style = "color: crimson">Game</span><span style = "color: navy">List</span>
                    </h1>
                    <h2 class="mb-4">
                        Welcome to GameList!
                    </h2>
                    @if (Route::has('login'))
                    @auth
                            <a class="btn btn-primary" href="{{ route('user.game.list') }}">Dashboard</a>
                    @else
                            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
    
                        @if (Route::has('register'))
                                <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                    @endif

                </div>
            </div>
        </div>
        
    </body>
</html>
