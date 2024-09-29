<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvinteDoMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvinte_do_mes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome')->nullable();
            $table->string('endereco')->nullable();
            $table->longText('avatar')->nullable();
            $table->integer('quantidade_de_pedidos')->nullable();
            $table->unsignedBigInteger('programa_favorito')->nullable();

            //Relacionamentos
            $table->foreign('programa_favorito')->references('id')->on('programas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvinte_do_mes');
    }
}
