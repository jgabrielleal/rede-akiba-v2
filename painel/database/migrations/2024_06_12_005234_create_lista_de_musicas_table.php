<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaDeMusicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_de_musicas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('numero_de_vezes_tocada')->nullable();
            $table->string('nome_da_anime')->nullable();
            $table->string('nome_da_musica')->nullable();
            $table->string('nome_do_artista')->nullable();
            $table->string('nome_do_album')->nullable();
            $table->string('ano_de_lancamento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_de_musicas');
    }
}
