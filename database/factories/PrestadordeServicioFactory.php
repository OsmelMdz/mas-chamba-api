<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrestadordeServicio>
 */
class PrestadordeServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipoCuenta = $this->faker->randomElement(["Premiun", "Normal"]);
        $nombre = $tipoCuenta == "Premiun" ? $this->faker->firstName() : $this->faker->company();
        $apellidoPaterno = $this->faker->lastName();
        $apellidoMaterno = $this->faker->lastName();
        // Generar nombres de archivo aleatorios para identificacion_personal, comprobante_domicilio y imagen
        $identificacionPersonal = $this->faker->unique()->word() . '.pdf';
        $comprobanteDomicilio = $this->faker->unique()->word() . '.pdf';
        $imagen = $this->faker->unique(true)->word() . '.jpg';
          // Obtener un usuario existente de forma aleatoria
        $user = User::inRandomOrder()->first();
        return [
            'nombre' => $nombre,
            'a_paterno' => $apellidoPaterno,
            'a_materno' => $apellidoMaterno,
            'tipo_cuenta' => $tipoCuenta,
            'fecha_nacimiento' => $this->faker->dateTime()->format('Y-m-d'),
            'imagen' => $imagen,
            'sexo' => $this->randomSexo(),
            'telefono' => $this->faker->phoneNumber(),
            'identificacion_personal' => $identificacionPersonal,
            'comprobante_domicilio' => $comprobanteDomicilio,
            'estatus' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'id_user' => $user->id
        ];
    }

    /**
     * Genera un valor aleatorio para el campo "sexo" entre 'Hombre', 'Mujer' y 'Prefiero no decir'.
     *
     * @return string
     */
    public function randomSexo()
    {
        return $this->faker->randomElement(['Hombre', 'Mujer', 'Prefiero no decir']);
    }
}
