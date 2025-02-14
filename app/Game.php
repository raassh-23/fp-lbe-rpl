<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'game_createdBy_users_id',
        'game_code',
        'game_name',
        'game_description',
        'game_imagePath',
        'game_createdAt',
        'game_updatedAt',
    ];

    protected $hidden = [
        'game_createdBy_users_id',
    ];

    // Custom primary key
    protected $primaryKey = 'game_id';

    public $timestamps = false;

    public function reviews()
    {
        return $this->hasMany('App\Review', 'rev_reviewAt_game_id');
    }
}
