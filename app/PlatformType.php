<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatformType extends Model
{
    protected $fillable = [
        'plt_name',
        'plt_dlImagePath',
    ];

    // Custom primary key
    protected $primaryKey = 'plt_id';

    public $timestamps = false;
}
