@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('user.game.list') }}">Game</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $game->game_name }}</li>
			</ol>
		</nav>

		@if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

		<div class="p-4 shadow bg-white shadow mt-4">
			<h1>{{$game->game_name}}<h1>
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
					<a href="{{ $p->gp_downloadLink }}">
						<img src="{{ route('platformImage', ['imageName' => $p->plt_dlImagePath]) }}" class="img-thumbnail" width="200" />
					</a>
				@endforeach
			@else
				<p class="h6">No download link is available.</p>
			@endif
		</div>
		
		<div class="p-4 shadow bg-white shadow mt-4 mb-4">
		<h2>Reviews</h2>
		@foreach($reviews as $review)
			<div @if(!$loop->last) class="mb-4" @endif>
				<h4> {{ $review->user->name }} </h4>
				<p class="mb-1"> {{ $review->rev_text }} </p>
				@if($review->user->id == Auth()->user()->id)
					<div class="btn-group" role="group" aria-label="Review Operation">
						<a href="{{ route('user.review.edit', ['game_code' => $game->game_code, ]) }}" class="btn btn-warning">Edit</a>
						<a href="{{ route('user.review.delete', ['game_code' => $game->game_code, ]) }}" class="btn btn-danger">Delete</a>
					</div>
				@endif
			</div>
			
		@endforeach
		</div>

			<p><a href=" {{ route('user.review.create', ['game_code' => $game->game_code, ]) }} " class="btn btn-primary">Add Review</a></p>
		
    </div>
@endsection