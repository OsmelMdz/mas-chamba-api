<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener los roles necesarios
        $roles = Role::whereIn('nombre', ['administradorGeneral', 'administradorBasico', 'prestadorDeServicio'])->get();

        // Crear usuarios para cada tipo de rol
        foreach ($roles as $role) {
            // Obtener los datos específicos para cada tipo de usuario
            $userData = $this->getUserDataForRole($role);

            // Crear usuario
            $user = User::factory()->create($userData);

            // Asignar rol al usuario
            $user->roles()->attach($role);
        }
    }

    /**
     * Obtiene los datos de usuario específicos para cada tipo de rol.
     */
    private function getUserDataForRole($role)
    {
        switch ($role->nombre) {
            case 'administradorGeneral':
                return [
                    'email' => 'admin_general@example.com',
                    'password' => bcrypt('password'),
                ];
            case 'administradorBasico':
                return [
                    'email' => 'admin_basico@example.com',
                    'password' => bcrypt('password'),
                ];
            case 'prestadorDeServicio':
                return [
                    'email' => 'prestador_servicio@example.com',
                    'password' => bcrypt('password'),
                ];
        }
    }
}
