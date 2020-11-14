@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
				<li class="breadcrumb-item"><a href="{{ route('admin.game.list') }}">Game</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit</li>
			</ol>
		</nav>
        
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="p-4 bg-white shadow rounded">
            <h1>Edit game</h1>
            <form method="POST" action="{{ route('admin.game.edit.process', ['game_id' => $game->game_id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="game_name">Game Name</label>
                    <input type="text" class="form-control" name="game_name" placeholder="Game name" value="{{ $game->game_name }}" />
                    @error('game_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="game_description">Game Description</label>
                    <textarea class="form-control" name="game_description" placeholder="Game description">{{ $game->game_description }}</textarea>
                    @error('game_description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection