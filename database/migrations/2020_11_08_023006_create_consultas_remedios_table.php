<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasRemediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_remedios', function (Blueprint $table) {
            $table->unsignedBigInteger('idConsultaRemedio')->primary();
            $table->unsignedBigInteger('idConsulta');
            $table->unsignedBigInteger('idRemedio');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('idConsulta')->on('consultas')->references('idConsulta');
            $table->foreign('idRemedio')->on('remedios')->references('idRemedio');
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
        Schema::dropIfExists('consultas_remedios');
    }
}
