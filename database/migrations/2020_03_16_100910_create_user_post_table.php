<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("animal_post_id");
            $table->foreign('animal_post_id')->references('id')->on('animalpost')->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('user')->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('user_post');
    }
}
