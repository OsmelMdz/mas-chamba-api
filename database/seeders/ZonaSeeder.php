<?php

namespace Database\Seeders;

use App\Models\Zona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /* public function run(): void
    {
        $calles = [
            'Aldama',
            'Allende',
            'Benito Juárez',
            'García Vigil',
            'Macedonio Alcalá',
            'Trujano',
            'Gurrión',
            'Porfirio Díaz',
            'Morelos',
            '5 de Mayo',
            '20 de Noviembre',
            'Mina',
            'Reforma',
            'Libres',
            'Zaragoza',
            'Abasolo',
            'González Ortega',
            'Pino Suárez',
            'Murguía',
            'Valdivieso',
            'J.P. García',
        ];
        foreach ($calles as $calle) {
            Zona::create([
                'nombre' => $calle,
                'estatus' => 'Activo',
            ]);
        }
    } */
}
