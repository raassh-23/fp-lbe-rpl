<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_types', function (Blueprint $table) {
            $table->bigIncrements('plt_id');
            $table->string('plt_name', 32);
            $table->string('plt_dlImagePath', 128);
            $table->datetime('plt_createdAt');
            $table->datetime('plt_updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platform_types');
    }
}
