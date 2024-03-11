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
        Schema::create('prestadorde_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno');
            $table->date('fecha_nacimiento');
            $table->text('imagen');
            $table->enum('sexo', ['Hombre', 'Mujer', 'Prefiero no decir']);
            $table->string('telefono');
            $table->text('identificacion_personal');
            $table->text('comprobante_domicilio');
            $table->string('email');
            $table->enum('tipo_cuenta', ['Premiun', 'Normal']); // Cambia tipo de cuenta del prestador de servicio a premiun o normal
            $table->enum('estatus', ['Activo', 'Inactivo']); // Cambia el estado del prestador de servicio a activo o inactivo
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestadorde_servicios');
    }
};
