@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Game</li>
            </ol>
        </nav>
        <h1>List Game</h1>
        <div class="row">
            @if (sizeof($games) > 0)
                @foreach($games as $game)
                    <div class="card">
                        <img class="img-thumbnail" src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" alt="Card image cap" width="200px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game->game_name }}</h5>
                            <p class="card-text">{{ $game->game_description }}</p>
                            <a href="{{ route('user.game.details', ['game_id' => $game->game_id]) }}" class="btn btn-primary btn-block btm-sm">Details</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    Tidak ada game terdaftar. Untuk mendaftarkan game, klik <a href="{{ route('admin.game.create') }}">di sini</a>
                </div>
            @endif
        </div>
        {{ $games->links() }}
    </div>
@endsection