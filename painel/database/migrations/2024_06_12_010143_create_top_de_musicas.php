<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopDeMusicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_de_musicas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('musica');
            $table->integer('numero_de_vezes_tocada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_de_musicas');
    }
}
