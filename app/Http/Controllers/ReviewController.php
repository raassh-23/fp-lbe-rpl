<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Carbon\Carbon;
use App\Game;

class ReviewController extends Controller
{   
    public function showCreatePage($game_code) {
        $game = Game::where('game_code', $game_code)->first();

        if(!$game) {
            abort(404);
        }

        if(Review::where([
            ['rev_reviewedBy_users_id', '=', Auth()->user()->id],
            ['rev_reviewAt_game_id', '=', $game->game_id],
        ])->exists()) {
            return redirect()->back()->with('message', 'You cannot review this game again');
        }

        return view('user.review.create', [
            'game' => $game,
        ]);
    
    }

    public function createReview($game_code, Request $request) {
        
        $rules = [
            'rev_text' => 'required|string|min:1|max:256',
        ];

        $request->validate($rules);

        $now = Carbon::now();

        Review::create([
            'rev_reviewedBy_users_id' => Auth()->user()->id,
            'rev_reviewAt_game_id' => $request->game_id,
            'rev_text' => $request->rev_text,
            'rev_createdAt' => $now,
            'rev_updatedAt' => $now,
        ]);

        return redirect()->route('user.game.details', ['game_code' => $game_code])->with('message', 'Review has been addded!');
    }

    public function showEditPage($game_code) {
        $game = Game::where('game_code', $game_code)->first();

        if(!$game) {
            abort(404);
        }

        $review = Review::where([
            ['rev_reviewedBy_users_id', '=', Auth()->user()->id],
            ['rev_reviewAt_game_id', '=', $game->game_id],
        ])->first();

        if(!$review) {
            abort(404);
        }

        return view('user.review.edit', [
            'game' => $game,
            'review' => $review,
        ]);
    
    }

    public function editReview($game_code, Request $request) {
        $review = Review::findOrFail($request->rev_id);

        $rules = [
            'rev_text' => 'required|string|min:1|max:256',
        ];

        $request->validate($rules);

        $review->rev_text = $request->rev_text;

        $review->save();

        return redirect()->route('user.game.details', ['game_code' => $game_code])->with('message', 'Review has been updated!');
    }

    public function showDeletePage($game_code) {
        $game = Game::where('game_code', $game_code)->first();

        if(!$game) {
            abort(404);
        }

        $review = Review::where([
            ['rev_reviewedBy_users_id', '=', Auth()->user()->id],
            ['rev_reviewAt_game_id', '=', $game->game_id],
        ])->first();

        if(!$review) {
            abort(404);
        }

        return view('user.review.delete', [
            'game' => $game,
            'review' => $review,
        ]);
    
    }

    public function deleteReview($game_code, Request $request) {
        $game = Review::findOrFail($request->rev_id);

        // Delete game
        $game->delete();
        
        return redirect()->route('user.game.details', ['game_code' => $game_code])->with('message', 'Review has been deleted!');
    }

}
