<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('rev_id');
            $table->unsignedBigInteger('rev_reviewedBy_users_id');
            $table->foreign('rev_reviewedBy_users_id')->references('id')->on('users');
            $table->string('rev_text', 256);
            $table->datetime('rev_createdAt');
            $table->datetime('rev_updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
