@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('user.game.list') }}">Game</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $game->game_name }}</li>
			</ol>
		</nav>
		<h1>Game Info</h1>
		<h2>{{$game->game_name}}<h2>
		<img src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" class="img-thumbnail mx-auto d-block" width="400">
		<p>{{ $game->game_description }}</p>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
@endsection