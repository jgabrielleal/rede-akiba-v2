<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('administrador');
            $table->unsignedBigInteger('executante');
            $table->string('tarefa_a_ser_executada')->nullable();
            $table->boolean('tarefa_concluida')->nullable();

            //Relacionamentos
            $table->foreign('administrador')->references('id')->on('users');
            $table->foreign('executante')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}
