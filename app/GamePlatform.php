<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamePlatform extends Model
{
    protected $fillable = [
        'gp_platform_id',
        'gp_game_id',
        'gp_downloadLink',
        'gp_createdAt',
        'gp_updatedAt',
    ];

    // Custom primary key
    protected $primaryKey = 'gp_id';

    public $timestamps = false;
}
