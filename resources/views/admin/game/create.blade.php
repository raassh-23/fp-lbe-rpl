<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        @if (Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif
        <form method="POST" action="{{ route('admin.game.create.process') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="game_name" placeholder="Game name" />
            <br />
            @error('game_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <textarea name="game_description" placeholder="Game description"></textarea>
            @error('game_description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <br />
            <input type="file" name="game_image" />
            @error('game_image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <br />
            <button type="submit">Create</button>
        </form>
    </body>
</html>