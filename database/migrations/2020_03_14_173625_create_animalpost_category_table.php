<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalpostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animalpost_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("animal_post_id");
            $table->foreign('animal_post_id')->references('id')->on('animalpost')->onDelete("cascade")->onUpdate("cascade");

            $table->unsignedBigInteger("cat_id");
            $table->foreign('cat_id')->references('id')->on('category')->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('animalpost_category');
    }
}
