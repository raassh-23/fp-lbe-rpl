@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.game.list') }}">Game</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.game.details', ['game_code' => $game->game_code, ]) }}">{{ $game->game_name }}</a></li>
				<li class="breadcrumb-item active" aria-current="page">Delete Review</li>
			</ol>
		</nav>
        <div class="p-4 bg-white shadow rounded">
            <h1 class="mb-4">Delete Review</h1>
            <h4> {{ $review->user->name }} </h4>
		    <p class="mb-4"> {{ $review->rev_text }} </p>
            <p class="h5">Are you sure you want to delete your review?</p>
            <form action="{{ route('user.review.delete.process', ['game_code' => $game->game_code]) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="rev_id" value="{{ $review->rev_id }}">
                <button type="submit" class="btn btn-danger btm-sm">Yes</button>
            </form>
        </div>
    </div>
@endsection