<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Carbon\Carbon;
use App\Game;

class ReviewController extends Controller
{
    public function createReview(Request $request) {

        $reviewBy = Auth()->user()->id;
        $reviewAt = $request->game_id;

        if(Review::where([
            ['rev_reviewedBy_users_id', '=', $reviewBy],
            ['rev_reviewAt_game_id', '=', $reviewAt],
        ])->exists()) {
            return redirect()->back()->with('message', 'You cannot review this game again');
        }

        $rules = [
            'rev_text' => 'required|string|min:1|max:256',
        ];

        $request->validate($rules);

        $now = Carbon::now();

        Review::create([
            'rev_reviewedBy_users_id' => $reviewBy,
            'rev_reviewAt_game_id' => $reviewAt,
            'rev_text' => $request->rev_text,
            'rev_createdAt' => $now,
            'rev_updatedAt' => $now,
        ]);

        return redirect()->back()->with('message', 'Review has been addded!');
    }
}
