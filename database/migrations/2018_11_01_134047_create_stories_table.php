<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
          $table->increments('id');

          $table->unsignedInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          //$table->unsignedInteger('theme_id');
          //$table->foreign('theme_id')->references('id')->on('theme');

          $table->string('title');
          $table->longText('text');
          $table->unsignedInteger('deleteVoted');

          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
