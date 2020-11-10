<?php

namespace App\Http\Controllers;

use App\Game;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Image;

class GameController extends Controller
{
    public function showCreatePage() {
        return view('admin.game.create');
    }

    public function createGame(Request $request) {
        $rules = [
            'game_name' => 'required|string|min:1|max:128',
            'game_description' => 'required|string|min:1|max:512',
            'game_image' => 'required|image|mimes:jpg,png,jpeg',
        ];

        // Validate
        $request->validate($rules);

        // Generate code
        $code = '';
        $code_existence = 1;
        do {
            $code = Str::random(8);
            $code_existence = Game::where('game_code', $code)->count();
        }
        while($code_existence > 0);

        // Carbon
        $now = Carbon::now();

        // Upload image
        $image = $request->file('game_image');
        $fileName = $code.'.'.$image->extension();
        Storage::disk('gameImage')->put($fileName, File::get($image));

        Game::create([
            'game_createdBy_users_id' => Auth()->user()->id,
            'game_code' => $code,
            'game_name' => $request->game_name,
            'game_description' => $request->game_description,
            'game_imagePath' => $fileName,
            'game_createdAt' => $now,
            'game_updatedAt' => $now,
        ]);

        return redirect()->route('admin.game.create')->with('message', 'Game has been addded!');
    }

    /**
     * Show game list.
     */
    public function showGameList() {
        $games = Game::orderBy('game_createdAt', 'DESC')->paginate(10);
        return view('admin.game.list', [
            'games' => $games,
        ]);
    }

    /**
     * Show edit page
     */
    public function showEditPage($game_id) {
        $game = Game::findOrFail($game_id);
        return view('admin.game.edit', [
            'game' => $game,
        ]);
    }

    /**
     * Show delete page
     */
    public function showDeletePage($game_id) {
        $game = Game::findOrFail($game_id);
        return view('admin.game.delete', [
            'game' => $game,
        ]);
    }

    /**
     * Edit game
     *
     * @param int       $game_id
     * @param Request   $request
     */
    
    public function editGame($game_id, Request $request) {
        $game = Game::findOrFail($game_id);

        // Validation rule
        $rules = [
            'game_name' => 'required|string|min:1|max:128',
            'game_description' => 'required|string|min:1|max:512',
        ];

        $request->validate($rules);

        $game->game_name = $request->game_name;
        $game->game_description = $request->game_description;

        $game->save();

        return redirect()->route('admin.game.edit', ['game_id' => $game_id])->with('message', 'Game has updated!');
    }

    /**
     * Get game image
     */
    public function getGameImage($imageName) {
        return Image::make(storage_path('gameImage/' . $imageName))->response();
    }

    /**
     * Delete game
     */
    public function deleteGame($game_id) {
        $game = Game::findOrFail($game_id)->delete();
        
        return redirect()->route('admin.game.list')->with('status', 'Game successfully deleted');
    }

    /**
     * Show game details page for admin
     */
    public function showDetailsPageAdmin($game_id) {
        $game = Game::findOrFail($game_id);
        return view('admin.game.details', [
            'game' => $game,
        ]);
    }

    /**
     * Show game details page for user
     */
    public function showDetailsPageUser($game_id) {
        $game = Game::findOrFail($game_id);
        return view('user.game.details', [
            'game' => $game,
        ]);
    }

    /**
     * Show game list for user
     */
    public function showGameListUser() {
        $games = Game::orderBy('game_createdAt', 'DESC')->paginate(10);
        return view('user.game.list', [
            'games' => $games,
        ]);
    }

}
