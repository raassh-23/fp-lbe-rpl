@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('user.game.list') }}">Game</a></li>
				<li class="breadcrumb-item" aria-current="page">{{ $game->game_name }}</li>
				<li class="breadcrumb-item active" aria-current="page">Add Review</li>
			</ol>
		</nav>

		<h1>Add Your Review</h1>
		<form method="POST" action="{{ route('user.review.create.process', ['game_code' => $game->game_code, ]) }}" enctype="multipart/form-data">
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