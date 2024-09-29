<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->unsignedBigInteger('autor');
            $table->longText('imagem_em_destaque')->nullable();
            $table->longText('capa_da_review')->nullable();
            $table->string('titulo')->nullable();
            $table->string('sinopse', 1000)->nullable();
            $table->json('conteudo')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
