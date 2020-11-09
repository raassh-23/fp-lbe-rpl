<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('game_id');
            $table->unsignedBigInteger('game_createdBy_users_id');
            $table->foreign('game_createdBy_users_id')->references('id')->on('users');
            $table->string('game_code', 8);
            $table->string('game_name', 128);
            $table->text('game_description');
            $table->string('game_imagePath');
            $table->datetime('game_createdAt');
            $table->datetime('game_updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
