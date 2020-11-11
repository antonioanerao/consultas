<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->unsignedBigInteger('idConsulta')->primary();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('idEspecialidade');
            $table->text('conteudoConsulta');
            $table->timestamps();
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('idEspecialidade')->on('especialidades')->references('idEspecialidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
