<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisosParaEquipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avisos_para_equipe', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('remetente');
            $table->unsignedInteger('destinatario');
            $table->string('mensagem')->nullable();

            //Relacionamentos
            $table->foreign('remetente')->references('id')->on('users');
            $table->foreign('destinatario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avisos_para_equipe');
    }
}
