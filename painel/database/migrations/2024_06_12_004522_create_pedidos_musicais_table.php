<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosMusicaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_musicais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('apelido_do_ouvinte')->nullable();
            $table->string('endereco_do_ouvinte')->nullable();
            $table->string('recado_para_o_locutor', 1000)->nullable();
            $table->unsignedBigInteger('programa_no_ar');
            $table->unsignedBigInteger('musica_pedida');

            //Relacionamentos
            $table->foreign('programa_no_ar')->references('id')->on('no_ar');
            $table->foreign('musica_pedida')->references('id')->on('lista_de_musicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_musicais');
    }
}
