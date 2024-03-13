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
        $usuarios = User::all();

        // Iterar sobre los usuarios y crear un prestador de servicios para cada uno
        foreach ($usuarios as $usuario) {
            PrestadordeServicio::factory()
                ->count(1)
                ->state(function (array $attributes) use ($usuario) {
                    return [
                        'id_user' => $usuario->id,
                    ];
                })
                ->hasCursos(10)
                ->hasCertificaciones(3)
                ->hasServicios(20)
                ->create();
        }
    }
}
