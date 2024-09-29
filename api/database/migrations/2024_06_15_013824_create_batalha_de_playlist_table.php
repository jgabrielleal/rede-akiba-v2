<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatalhaDePlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batalha_de_playlist', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('imagem')->nullable();
            $table->unsignedInteger('primeiro_competidor')->nullable();
            $table->unsignedInteger('segundo_competidor')->nullable();

            //Relacionamentos
            $table->foreign('primeiro_competidor')->references('id')->on('users');
            $table->foreign('segundo_competidor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batalha_de_playlist');
    }
}
