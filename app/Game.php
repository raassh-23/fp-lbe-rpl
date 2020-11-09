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
}
