<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->unsignedBigInteger('autor');
            $table->string('titulo')->nullable();
            $table->string('imagem_em_destaque')->nullable();
            $table->string('capa_do_evento')->nullable();
            $table->string('datas')->nullable();
            $table->string('local')->nullable();
            $table->string('conteudo')->nullable();

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
        Schema::dropIfExists('eventos');
    }
}
