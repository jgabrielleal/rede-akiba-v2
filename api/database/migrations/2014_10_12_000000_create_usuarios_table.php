<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->rememberToken();
            $table->string('slug');
            $table->boolean('ativo');
            $table->string('login');
            $table->string('senha');
            $table->json('niveis_de_acesso');
            $table->string('avatar')->nullable();
            $table->string('nome')->nullable();
            $table->string('apelido')->nullable();
            $table->string('email')->nullable();
            $table->integer('idade')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('biografia', 1000)->nullable();
            $table->json('redes_sociais')->nullable();
            $table->json('gostos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
