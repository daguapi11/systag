<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignaturaMatriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignatura_matricula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignatura_id')->constrained()->cascadeOnDelete();
            $table->foreignId('matricula_id')->constrained()->cascadeOnDelete();
            $table->boolean('estado_calificacion')->default(false);
            $table->boolean('estado_suspenso')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignatura_matricula');
    }
}
