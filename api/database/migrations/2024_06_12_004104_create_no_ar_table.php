<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoArTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('no_ar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('programa');
            $table->boolean('controle_de_pedidos')->nullable();
            $table->string('tipo_de_transmissao')->nullable();
            $table->date('data_da_transmissao')->nullable();
            $table->time('inicio_da_transmissao')->nullable();
            $table->time('fim_da_transmissao')->nullable();

            //Relacionamentos
            $table->foreign('programa')->references('id')->on('programas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('no_ar');
    }
}
