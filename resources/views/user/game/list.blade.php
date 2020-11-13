@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Game</li>
            </ol>
        </nav>
        <h1 class="mb-4">Games</h1>
        @if (sizeof($games) > 0)
            @foreach($games as $game)
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <tr class="bg-white m-4 shadow">
                                <th class="p-4" style="width:456px; text-align:center"><img class="img-fluid" src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" alt="Card image cap" width="200px"></th>
                                <th class="p-4" style="width:456px">
                                    <h5 class="card-title" style = "text-align:left">{{ $game->game_name }}</h5>
                                    <p class="card-text" style = "text-align:left">{{ $game->game_description }}</p>
                                </th>
                                <th class="p-4" style="width:228px; vertical-align:bottom"><a href="{{ route('user.game.details', ['game_code' => $game->game_code]) }}" class="btn btn-primary btn-block btm-sm">Details</a></th>
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
        <div class="float-right">
            {{ $games->links() }}
        </div>
    </div>
@endsection