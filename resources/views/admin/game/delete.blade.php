@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
				<li class="breadcrumb-item"><a href="{{ route('admin.game.list') }}">Game</a></li>
				<li class="breadcrumb-item active" aria-current="page">Delete</li>
			</ol>
		</nav>
        <div class="p-4 bg-white shadow rounded">
            <h1 class="mb-4">Delete Game</h1>
            <img src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" class="img-fluid d-block mx-auto" width="400">
            <p class="text-center h6 mt-2">{{$game->game_name}}<p>
            <h3>Description</h3>
            <p class="h6 mb-4">{{ $game->game_description }}</p>
            <p class="h5">Are you sure you want to delete this game?</p>
            <form action="{{ route('admin.game.delete.process', ['game_id' => $game->game_id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btm-sm">Yes</button>
            </form>
        </div>
    </div>
@endsection