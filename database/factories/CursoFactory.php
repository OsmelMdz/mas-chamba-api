<?php

namespace Database\Factories;

use App\Models\PrestadordeServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
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
            'imagen' => $this->faker->image('public/storage/images', 400, 300, null, false),
            'estatus' => $this->faker->randomElement(['Habilitado', 'Deshabilitado']),
        ];
    }
}
