<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendario', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('data')->nullable();
            $table->time('hora')->nullable();
            $table->string('evento')->nullable();
            $table->unsignedBigInteger('designado');
            $table->string('categoria')->nullable();

            //Relacionamentos
            $table->foreign('designado')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendario');
    }
}