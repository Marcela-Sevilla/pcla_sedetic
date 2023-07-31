<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pe_04s', function (Blueprint $table) {
            $table->id();
            $table->string('NOMBRE_PROGRAMA_FORMACION', 300);
            $table->char('CODIGO_PROGRAMA', 200);
            $table->char('VERSION_PROGRAMA', 200);
            $table->string('NIVEL_FORMACION', 300);
            $table->integer('DURACION_PROGRAMA');
            $table->string('MODALIDAD_FORMACION', 300);
            $table->integer('TOTAL_APRENDICES');
            $table->integer('TOTAL_APRENDICES_ACTIVOS');
            $table->char('IDENTIFICADOR_FICHA', 200);
            $table->string('ESTADO_CURSO', 300);
            $table->string('ETAPA_FICHA', 300);
            $table->char('FECHA_INICIO_FICHA', 200);
            $table->char('FECHA_TERMINACION_FICHA', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pe_04s');
    }
};
