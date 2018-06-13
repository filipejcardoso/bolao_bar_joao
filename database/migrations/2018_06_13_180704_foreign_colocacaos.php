<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignColocacaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apostas_colocacaos', function (Blueprint $table) {
            $table->unsignedInteger('participante_id');
            $table->foreign('participante_id')->references('id')->on('participantes')->onDelete('cascade');
            $table->foreign('primeiro')->references('id')->on('times');
            $table->foreign('segundo')->references('id')->on('times');
            $table->foreign('terceiro')->references('id')->on('times');
            $table->foreign('quarto')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apostas_colocacaos', function (Blueprint $table) {
            //
        });
    }
}
