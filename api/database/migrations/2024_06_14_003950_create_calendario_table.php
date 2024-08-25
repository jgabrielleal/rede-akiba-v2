SQLSTATE[42S02]: Base table or view not found: 1146 Table 'akiba.calendario_da_equipe' doesn't exist (SQL: insert into `calendario_da_equipe` (`slug`, `autor`, `titulo`, `imagem_em_destaque`, `capa_do_evento`, `datas`, `local`, `conteudo`, `updated_at`, `created_at`) values (error-veniam-cumque-ut-ducimus-occaecati-tempora, 32, Suscipit eum consequuntur nulla placeat est cupiditate et., C:\Users\João\AppData\Local\Temp\phpDEA4.tmp, C:\Users\João\AppData\Local\Temp\phpDEB4.tmp, 2024-09-28 18:17:00, 5758 Tina Crest Suite 692
Botsfordland, MS 82110-2885, Velit repellat possimus tempora dolorem inventore ea. Quod sint tempore ut voluptas. Quasi alias autem recusandae dolor consequatur sit. Ipsam laborum eius esse., 2024-07-15 00:58:32, 2024-07-15 00:58:32))<?php

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
            $table->string('dia')->nullable();
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