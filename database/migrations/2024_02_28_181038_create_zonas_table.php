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
        Schema::create('zonas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estatus', ['Activo', 'Inactivo']); //Cambia el estatus de la zona a Inactivo cuando se elimina una zona
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
        Schema::dropIfExists('zonas');
    }
};
