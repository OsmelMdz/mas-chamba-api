<?php

namespace Database\Seeders;

use App\Models\PrestadordeServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestadordeServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generar prestadores de servicio con diferentes cantidades de relaciones
        PrestadordeServicio::factory()
            ->count(10)
            ->hasCursos(10)
            ->hasCertificaciones(6)
            ->hasServicios(20)
            ->create();

        PrestadordeServicio::factory()
            ->count(10)
            ->hasCursos(5)
            ->hasCertificaciones(3)
            ->hasServicios(10)
            ->create();

        PrestadordeServicio::factory()
            ->count(10)
            ->hasCursos(1)
            ->hasCertificaciones(1)
            ->hasServicios(5)
            ->create();

        // Generar prestadores de servicio adicionales sin relaciones
        PrestadordeServicio::factory()
            ->count(10)
            ->create();
    }
}
