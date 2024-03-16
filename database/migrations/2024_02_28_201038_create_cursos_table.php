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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->binary('imagen');
            $table->enum('estatus', ['Habilitado', 'Deshabilitado']);
            $table->unsignedBigInteger('prestadorde_servicio_id');
            $table->foreign('prestadorde_servicio_id')->references('id')->on('prestadorde_servicios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
