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
    /* public function run()
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


     * Obtiene los datos de usuario específicos para cada tipo de rol.

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
    } */

    public function run()
    {
        // Crear un único administrador general
        $this->createAdminGeneral();

        // Crear múltiples administradores básicos
        $this->createAdminsBasicos();

        // Crear múltiples prestadores de servicio
        $this->createPrestadoresServicio();
    }

    /**
     * Crear un único administrador general.
     */
    private function createAdminGeneral()
    {
        $role = Role::where('nombre', 'administradorGeneral')->first();

        if ($role) {
            $adminData = [
                'email' => 'cursos@mascapacitacion.com.mx',
                'password' => bcrypt('MasChamba2024xJV'),
            ];

            $admin = User::factory()->create($adminData);
            $admin->roles()->attach($role);
        }
    }

    /**
     * Crear múltiples administradores básicos.
     */
    private function createAdminsBasicos()
    {
        $role = Role::where('nombre', 'administradorBasico')->first();

        if ($role) {
            $totalAdmins = 2;

            for ($i = 1; $i <= $totalAdmins; $i++) {
                $adminData = [
                    'email' => 'admin_basico_' . $i . '@mascapacitacion.com',
                    'password' => bcrypt('password'),
                ];

                $admin = User::factory()->create($adminData);
                $admin->roles()->attach($role);
            }
        }
    }

    /**
     * Crear múltiples prestadores de servicio.
     */
    private function createPrestadoresServicio()
    {
        $role = Role::where('nombre', 'prestadorDeServicio')->first();

        if ($role) {
            $totalPrestadores = 10;

            for ($i = 1; $i <= $totalPrestadores; $i++) {
                $prestadorData = [
                    'email' => 'prestador_servicio_' . $i . '@maschamba.com',
                    'password' => bcrypt('password'),
                ];

                $prestador = User::factory()->create($prestadorData);
                $prestador->roles()->attach($role);
            }
        }
    }
}
