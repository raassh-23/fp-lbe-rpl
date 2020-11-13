<?php

namespace App\Http\Controllers;

use App\Game;
use App\GamePlatform;
use App\PlatformType;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Storage;

class GameController extends Controller
{

    /**
     * Show game creation page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showCreatePage() {
        $platforms = PlatformType::get();
        return view('admin.game.create', [
            'platforms' => $platforms,
        ]);
    }

    /**
     * Create game
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createGame(Request $request) {
        $rules = [
            'game_name' => 'required|string|min:1|max:128',
            'game_description' => 'required|string|min:1|max:512',
            'game_image' => 'required|image|mimes:jpg,png,jpeg',
            'game_plt' => 'nullable|array',
            'game_plt.*' => 'nullable|active_url|min:1|max:256',
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

        $game_id = Game::insertGetId([
            'game_createdBy_users_id' => Auth()->user()->id,
            'game_code' => $code,
            'game_name' => $request->game_name,
            'game_description' => $request->game_description,
            'game_imagePath' => $fileName,
            'game_createdAt' => $now,
            'game_updatedAt' => $now,
        ]);

        // Platform adder
        if(!is_null($request->game_plt)) {
            foreach($request->game_plt as $key => $val) {
                if(!is_null($val)) {
                    $platform = PlatformType::find($key);
                    // If platforme exists
                    if($platform) {
                        GamePlatform::create([
                            'gp_game_id' => $game_id,
                            'gp_platform_id' => $key,
                            'gp_downloadLink' => $val,
                            'gp_createdAt' => $now,
                            'gp_updatedAt' => $now,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.game.create')->with('message', 'Game has been addded!');
    }

    /**
     * Show game list.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showGameList() {
        $games = Game::orderBy('game_createdAt', 'DESC')->paginate(10);
        return view('admin.game.list', [
            'games' => $games,
        ]);
    }

    /**
     * Show edit page
     *
     * @param int $game_id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showEditPage($game_id) {
        $game = Game::findOrFail($game_id);
        return view('admin.game.edit', [
            'game' => $game,
        ]);
    }

    /**
     * Show delete page
     *
     * @param int $game_id
     * @return \Illuminate\Contracts\Support\Renderable
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
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @param string $imageName
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getGameImage($imageName) {
        return Image::make(storage_path('gameImage/' . $imageName))->response();
    }

    /**
     * Get platform image
     *
     * @param string $imageName
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPlatformImage($imageName) {
        return Image::make(storage_path('platformImage/' . $imageName))->response();
    }

    /**
     * Delete game
     *
     * @param int $game_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGame($game_id) {
        $game = Game::findOrFail($game_id);

        // Delete game
        $game->delete();
        
        return redirect()->route('admin.game.list')->with('message', 'Game has been deleted!');
    }

    /**
     * Show game details page for admin
     *
     * @param int $game_id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDetailsPageAdmin($game_id) {
        $game = Game::findOrFail($game_id);
        $platform = GamePlatform::where('gp_game_id', $game->game_id)
                    ->join('platform_types', 'game_platforms.gp_platform_id', 'platform_types.plt_id')
                    ->get();
        return view('admin.game.details', [
            'game' => $game,
            'platform' => $platform,
        ]);
    }

    /**
     * Show game details page for user
     *
     * @param string $game_code
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDetailsPageUser($game_code) {
        $game = Game::where('game_code', $game_code)->first();
        if(!$game)
            abort(404);
        $platform = GamePlatform::where('gp_game_id', $game->game_id)
            ->join('platform_types', 'game_platforms.gp_platform_id', 'platform_types.plt_id')
            ->get();
        return view('user.game.details', [
            'game' => $game,
            'platform' => $platform,
        ]);
    }

    /**
     * Show game list for user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showGameListUser() {
        $games = Game::orderBy('game_createdAt', 'DESC')->paginate(10);
        return view('user.game.list', [
            'games' => $games,
        ]);
    }

}
