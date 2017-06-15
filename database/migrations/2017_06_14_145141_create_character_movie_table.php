<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_movie', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('character_id')->unsigned();
            $table->foreign('character_id')
                  ->references('id')
                  ->on('characters')
                  ->onDelete('cascade');

            $table->integer('movie_id')->unsigned();
            $table->foreign('movie_id')
                  ->references('id')
                  ->on('movies')
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
        Schema::dropIfExists('character_movie');
    }
}
