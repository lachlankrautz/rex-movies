<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_image', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('actor_id')->unsigned();
            $table->foreign('actor_id')
                  ->references('id')
                  ->on('actors')
                  ->onDelete('cascade');

            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')
                  ->references('id')
                  ->on('images')
                  ->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('actor_image');
    }
}
