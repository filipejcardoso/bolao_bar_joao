<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApostasColocacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apostas_colocacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('primeiro')->nullable();
            $table->unsignedInteger('segundo')->nullable();
            $table->unsignedInteger('terceiro')->nullable();
            $table->unsignedInteger('quarto')->nullable();
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
        Schema::dropIfExists('apostas_colocacaos');
    }
}
