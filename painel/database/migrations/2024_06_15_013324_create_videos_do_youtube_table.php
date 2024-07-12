<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosDoYoutubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_do_youtube', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('autor');
            $table->string('titulo_do_video')->nullable();
            $table->string('identificador_do_video')->nullable();

            //Relacionamentos
            $table->foreign('autor')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos_do_youtube');
    }
}
