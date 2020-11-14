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

		
		<div class="p-4 shadow bg-white shadow mt-4">
			<h1>{{$game->game_name}}<h1>
				<div class="btn-group float-right" role="group" aria-label="Admin Operation">
					<a href="{{ route('admin.game.delete', ['game_id' => $game->game_id]) }}" class="btn btn-danger btm-sm">Delete</a>
					<a href="{{ route('admin.game.edit', ['game_id' => $game->game_id]) }}" class="btn btn-warning btm-sm">Edit</a>
				</div>
			<img src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" class="img-thumbnail mx-auto d-block" width="400" />
			<p class="text-center h6 mt-2">{{ $game->game_name }} picture</p>
			<h3>Description</h3>
			
			<p class="h6">{{ $game->game_description }}</p>
			<h3 class="mt-4">Available on</h3>
			@if (sizeof($platform) > 0)
				<ul>
				@foreach($platform as $p)
					<li>{{ $p->plt_name }}</li>
				@endforeach
				</ul>
			@else
				<p class="h6">-</p>
			@endif
		</div>
		<div class="p-4 shadow bg-white shadow mt-4 mb-4">
			<h3>Download Now!</h3>
			
			@if (sizeof($platform) > 0)
				@foreach($platform as $p)
					<img src="{{ route('platformImage', ['imageName' => $p->plt_dlImagePath]) }}" class="img-thumbnail" width="200">
				@endforeach
			@else
				<p class="h6">No download link is available.</p>
			@endif
		</div>
		
    </div>
@endsection