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
		<h2>{{$game->game_name}}<>
		<img src="{{ route('gameImage', ['imageName' => $game->game_imagePath]) }}" class="img-thumbnail mx-auto d-block" width="400">
		<p>{{ $game->game_description }}</p>
		
		<h2>Reviews</h2>

		<form method="POST" action="{{ route('user.review.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="rev_text">Your Review</label>
                <textarea class="form-control" name="rev_text" placeholder="Your Review" required></textarea>
                @error('rev_text')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
			</div>
			<input type="hidden" name="game_id" value="{{ $game->game_id }}">
            <button type="submit" class="btn btn-primary">Add review</button>
        </form>
		
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
@endsection