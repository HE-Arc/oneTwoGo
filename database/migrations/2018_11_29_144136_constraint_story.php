<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConstraintStory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constraint_story', function (Blueprint $table) {
            $table->unsignedInteger('constraint_id');
            $table->foreign('constraint_id')->references('id')->on('constraints');
            $table->unsignedInteger('story_id');
            $table->foreign('story_id')->references('id')->on('stories');            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constraint_story');
    }
}
