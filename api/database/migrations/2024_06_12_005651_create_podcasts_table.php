<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->unsignedBigInteger('autor');
            $table->integer('temporada')->nullable();
            $table->integer('episodio')->nullable();
            $table->string('titulo_do_episodio')->nullable();
            $table->longText('capa_do_episodio')->nullable();
            $table->longText('descricao_do_episodio')->nullable();
            $table->longText('conteudo_da_publicacao')->nullable();
            $table->string('endereco_do_audio')->nullable();
            $table->json('agregadores')->nullable();

            //Relacionamentos
            $table->foreign('autor')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('podcasts');
    }
}
