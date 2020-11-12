@extends('layouts.app')

@section('content')
    <div class="container" style="background-color:gold">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Game</li>
            </ol>
        </nav>
        <h1>List Game</h1>
        <div class="row">
            @if (sizeof($games) > 0)
                @foreach($games as $game)
                    <div class="container">
                        <div class="col">
                            <table>
                                <tr>
                                    <th style="width:456px; text-align:center"><img class="img-thumbnail" src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" alt="Card image cap" width="200px"></th>
                                    <th style="width:456px">
                                        <h5 class="card-title" style = "text-align:left">{{ $game->game_name }}</h5>
                                        <p class="card-text" style = "text-align:left">{{ $game->game_description }}</p>
                                    </th>
                                    <th style="width:228px; vertical-align:bottom"><a href="{{ route('user.game.details', ['game_code' => $game->game_code]) }}" class="btn btn-primary btn-block btm-sm">Details</a></th>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    Tidak ada game terdaftar.
                </div>
            @endif
        </div>
        {{ $games->links() }}
    </div>
@endsection