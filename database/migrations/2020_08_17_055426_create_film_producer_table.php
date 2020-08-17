<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmProducerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_producer', function (Blueprint $table) {
            $table->integer('film_id')->unsigned();
            $table->foreign('film_id')->references('id')->on('film');
            $table->integer('producer_id')->unsigned();
            $table->foreign('producer_id')->references('id')->on('producer');
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
        Schema::dropIfExists('film_producer');
    }
}