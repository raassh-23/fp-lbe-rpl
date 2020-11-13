<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_platforms', function (Blueprint $table) {
            $table->bigIncrements('gp_id');
            $table->unsignedBigInteger('gp_platform_id');
            $table->foreign('gp_platform_id')->references('plt_id')->on('platform_types');
            $table->unsignedBigInteger('gp_game_id');
            $table->foreign('gp_game_id')->references('game_id')->on('games');
            $table->string('gp_downloadLink', 256);
            $table->datetime('gp_createdAt');
            $table->datetime('gp_updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_platforms');
    }
}
