<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositorioDeArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositorio_de_arquivos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('uploader');
            $table->string('nome_do_arquivo')->nullable();
            $table->string('icone_do_arquivo')->nullable();
            $table->string('endereco_de_download')->nullable();
            $table->string('categoria')->nullable();

            //Relacionamentos
            $table->foreign('uploader')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repositorio_de_arquivos');
    }
}
