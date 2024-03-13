<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrador>
 */
class AdministradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         // Obtener un usuario existente de forma aleatoria
         $user = User::inRandomOrder()->first();
        return [
            'nombre' => $this->faker->firstName(),
            'estatus' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'id_user' => $user->id
        ];
    }
}
