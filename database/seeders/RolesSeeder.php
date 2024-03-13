<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ['nombre' => 'administradorGeneral'],
            ['nombre' => 'administradorBasico'],
            ['nombre' => 'prestadorDeServicio'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }
    }
}
