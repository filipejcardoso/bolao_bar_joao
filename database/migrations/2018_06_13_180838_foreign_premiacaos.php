<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignPremiacaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apostas_premiacaos', function (Blueprint $table) {
            $table->unsignedInteger('participante_id');
            $table->foreign('participante_id')->references('id')->on('participantes')->onDelete('cascade');
            $table->foreign('artilheiro')->references('id')->on('jogadores');
            $table->foreign('ataque')->references('id')->on('times');
            $table->foreign('defesa')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apostas_premiacaos', function (Blueprint $table) {
            //
        });
    }
}
