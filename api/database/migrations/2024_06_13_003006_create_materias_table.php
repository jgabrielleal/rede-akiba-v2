<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->boolean('publicado');
            $table->unsignedBigInteger('autor');
            $table->string('imagem_em_destaque')->nullable();
            $table->string('capa_da_materia')->nullable();
            $table->string('titulo')->nullable();
            $table->longText('conteudo')->nullable();
            $table->json('tags')->nullable();
            $table->json('fontes_de_pesquisa')->nullable();
            $table->json('reacoes')->nullable();

            //Relacionamento
            $table->foreign('autor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
