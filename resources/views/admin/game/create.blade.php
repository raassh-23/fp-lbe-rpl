@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.game.list') }}">Game</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
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
            @foreach($platforms as $p)
            <div class="form-group">
                <label for="game_name">Download link for {{ $p->plt_name }}</label>
                <input type="text" class="form-control" name="game_plt[{{ $p->plt_id }}]" placeholder="https://..." />
                @error('game_plt.'.$p->plt_id)
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
@push('footer_script')
@endpush