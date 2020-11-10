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
        <h1>Are you sure you want to delete this game?</h1>
		<h2>{{$game->game_name}}<h2>
		<img src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" class="img-thumbnail" width="400">
        <p>{{ $game->game_description }}</p>

        <form action="{{ route('admin.game.delete.process', ['game_id' => $game->game_id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-block btm-sm">Yes</button>
        </form>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
@endsection