@extends('layouts.app')

@section('content')
    <div class="container" style = "background-color: gold;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Game</li>
            </ol>
        </nav>
        <h1>List Game</h1>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        @if (sizeof($games) > 0)
        <table class="table">
            <!-- <thead>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Gambar Game</th>
                <th scope="col">Nama Game</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">*</th>
                </tr>
            </thead> -->
            <tbody>
                @foreach($games as $g)
                <tr>
                    <!-- <th scope="row">{{ $loop->index + 1 }}</th> -->
                    <td><img src="{{ route('gameImage', ['imageName' => $g->game_imagePath]) }}" class="img-thumbnail" width="400"></td>
                    <td><h2>{{ $g->game_name }}</h2>
                    {{ $g->game_description }}</td>
                    <td style = "vertical-align:bottom">
                        
                        <a href="{{ route('admin.game.details', ['game_id' => $g->game_id]) }}" class="btn btn-primary btn-block btm-sm">Details</a>
                        <a href="{{ route('admin.game.delete', ['game_id' => $g->game_id]) }}" class="btn btn-danger btn-block btm-sm">Delete</a>
                        <a href="{{ route('admin.game.edit', ['game_id' => $g->game_id]) }}" class="btn btn-warning btn-block btm-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-info">
            Tidak ada game terdaftar. Untuk mendaftarkan game, klik <a href="{{ route('admin.game.create') }}">di sini</a>
        </div>
        @endif
        {{ $games->links() }}
        <a href="{{ route('admin.game.create') }}" class="btn btn-success float-right">Create new game</a>
    </div>
@endsection