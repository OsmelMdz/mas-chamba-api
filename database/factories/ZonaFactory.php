<?php

namespace Database\Factories;

use App\Models\PrestadordeServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zona>
 */
class ZonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prestadorId = PrestadordeServicio::pluck('id')->random();
        return [
            'prestadorde_servicio_id' => $prestadorId,
            'nombre' => $this->faker->sentence(),
            'estatus' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}
