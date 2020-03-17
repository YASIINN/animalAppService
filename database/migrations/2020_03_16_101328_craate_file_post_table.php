<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraateFilePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('filepost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("animal_post_id");
            $table->foreign('animal_post_id')->references('id')->on('animalpost')->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger("file_id");
            $table->foreign('file_id')->references('id')->on('file')->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('filepost');

    }
}
