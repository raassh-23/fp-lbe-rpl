@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Game</li>
            </ol>
        </nav>
        <a href="{{ route('admin.game.create') }}" class="btn btn-success float-right">Create new game</a>
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
                                <th class="p-4" style="width:228px; vertical-align:bottom">
                                <div class="btn-group float-right" role="group" aria-label="Admin Operation">
                                    <a href="{{ route('admin.game.details', ['game_id' => $game->game_id]) }}" class="btn btn-primary btn-block btm-sm">Details</a>
                                    <a href="{{ route('admin.game.edit', ['game_id' => $game->game_id]) }}" class="btn btn-warning btm-sm">Edit</a>
                                    <a href="{{ route('admin.game.delete', ['game_id' => $game->game_id]) }}" class="btn btn-danger btm-sm">Delete</a>
                                </div>
                                </th>
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