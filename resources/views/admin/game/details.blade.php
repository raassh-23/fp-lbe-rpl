@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
				<li class="breadcrumb-item"><a href="{{ route('admin.game.list') }}">Game</a></li>
				<li class="breadcrumb-item active" aria-current="page">Details</li>
			</ol>
		</nav>
		<h1>Game Info</h1>
		<h2>{{$game->game_name}}<h2>
		<img src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" class="img-thumbnail" width="400">
		<p>{{ $game->game_description }}</p>

		<a href="{{ route('admin.game.delete', ['game_id' => $game->game_id]) }}" class="btn btn-danger btn-block btm-sm">Delete</a>
        <a href="{{ route('admin.game.edit', ['game_id' => $game->game_id]) }}" class="btn btn-warning btn-block btm-sm">Edit</a>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
@endsection