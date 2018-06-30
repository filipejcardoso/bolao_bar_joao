<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosPremiacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados_premiacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artilheiro')->nullable();
            $table->unsignedInteger('ataque')->nullable();
            $table->unsignedInteger('defesa')->nullable();
            $table->foreign('artilheiro')->references('id')->on('jogadores');
            $table->foreign('ataque')->references('id')->on('times');
            $table->foreign('defesa')->references('id')->on('times');
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
        Schema::dropIfExists('resultados_premiacaos');
    }
}
