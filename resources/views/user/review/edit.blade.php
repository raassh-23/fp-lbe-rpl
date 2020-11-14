@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.game.list') }}">Game</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.game.details', ['game_code' => $game->game_code, ]) }}">{{ $game->game_name }}</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Review</li>
			</ol>
		</nav>
        <div class="p-4 bg-white shadow rounded">
            <h1>Edit Your Review</h1>
            <form method="POST" action="{{ route('user.review.edit.process', ['game_code' => $game->game_code, ]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="rev_text">Your Review</label>
                    <textarea class="form-control" name="rev_text" placeholder="Your Review" required> {{ $review->rev_text }} </textarea>
                    @error('rev_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <input type="hidden" name="rev_id" value="{{ $review->rev_id }}">
                <button type="submit" class="btn btn-primary">Edit review</button>
            </form>
        </div>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
@endsection