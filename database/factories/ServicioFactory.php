<?php

namespace Database\Factories;

use App\Models\PrestadordeServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagen = $this->faker->unique(true)->word() . '.jpg';
        $prestadorId = PrestadordeServicio::pluck('id')->random();
        return [
            'prestadorde_servicio_id' => $prestadorId,
            'nombre' => $this->faker->sentence(),
            'descripcion' => $this->faker->text(200),
            'imagen' => $imagen,
            'estatus' => $this->faker->randomElement(['Habilitado', 'Deshabilitado']),
        ];
    }
}
