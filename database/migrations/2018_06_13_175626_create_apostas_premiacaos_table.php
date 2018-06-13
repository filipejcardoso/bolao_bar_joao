<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApostasPremiacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apostas_premiacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artilheiro')->nullable();
            $table->unsignedInteger('ataque')->nullable();
            $table->unsignedInteger('defesa')->nullable();
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
        Schema::dropIfExists('apostas_premiacaos');
    }
}
