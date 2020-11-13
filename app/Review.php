<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'rev_reviewedBy_users_id',
        'rev_reviewAt_game_id',
        'rev_text',
        'rev_createdAt',
        'rev_updatedAt',
    ];

    protected $primaryKey = 'rev_id';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'rev_reviewedBy_users_id');
    }
}
