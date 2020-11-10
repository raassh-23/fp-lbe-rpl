@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a new game</h1>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.game.create.process') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="game_name">Game Name</label>
                <input type="text" class="form-control" name="game_name" placeholder="Game name" />
                @error('game_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="game_description">Game Description</label>
                <textarea class="form-control" name="game_description" placeholder="Game description"></textarea>
                @error('game_description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="game_image">Game Image</label>
                <input type="file" class="form-control-file" name="game_image" />
                @error('game_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection