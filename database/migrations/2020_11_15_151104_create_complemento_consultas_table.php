<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplementoConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complemento_consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idConsulta');
            $table->unsignedBigInteger('user_id');
            $table->text('conteudoComplementoConsulta');
            $table->timestamps();
            $table->foreign('idConsulta')->on('consultas')->references('idConsulta');
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complemento_consultas');
    }
}
