<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasSintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_sintomas', function (Blueprint $table) {
            $table->unsignedBigInteger('idConsultaSintoma')->primary();
            $table->unsignedBigInteger('idSintoma');
            $table->unsignedBigInteger('idConsulta');
            $table->timestamps();
            $table->foreign('idSintoma')->on('sintomas')->references('idSintoma');
            $table->foreign('idConsulta')->on('consultas')->references('idConsulta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas_sintomas');
    }
}
