<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $usuarios = User::whereHas('roles', function ($query) {
            $query->where('nombre', 'administradorBasico');
        })->get();


        // Iterar sobre los usuarios y crear un prestador de servicios para cada uno
        foreach ($usuarios as $usuario) {
            Administrador::factory()
                ->count(1)
                ->state(function (array $attributes) use ($usuario) {
                    return [
                        'id_user' => $usuario->id,
                    ];
                })
                ->create();
        }
    }
}
