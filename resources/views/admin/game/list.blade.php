<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>List Game</h1>
        <ol>
        @foreach($games as $g)
            <li>{{ $g->game_name }}</li>
        @endforeach
        </ol>
        {{ $games->links() }}
    </body>
</html>