<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosColocacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados_colocacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('primeiro')->nullable();
            $table->unsignedInteger('segundo')->nullable();
            $table->unsignedInteger('terceiro')->nullable();
            $table->unsignedInteger('quarto')->nullable();
            $table->foreign('primeiro')->references('id')->on('times');
            $table->foreign('segundo')->references('id')->on('times');
            $table->foreign('terceiro')->references('id')->on('times');
            $table->foreign('quarto')->references('id')->on('times');
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
        Schema::dropIfExists('resultados_colocacaos');
    }
}
