<?php

namespace Database\Seeders;

use App\Models\PrestadordeServicio;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestadordeServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Obtener todos los usuarios que tengan el rol de "prestador de servicio"
        $usuarios = User::whereHas('roles', function ($query) {
            $query->where('nombre', 'prestadorDeServicio');
        })->get();

        // Iterar sobre los usuarios y crear un prestador de servicios para cada uno
        foreach ($usuarios as $usuario) {
            PrestadordeServicio::factory()
                ->count(1)
                ->state(function (array $attributes) use ($usuario) {
                    return [
                        'id_user' => $usuario->id,
                    ];
                })
                ->hasCursos(2)
                ->hasCertificaciones(1)
                ->hasServicios(5)
                ->hasZonas(10)
                ->create();
        }
    }
}
