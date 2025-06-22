<?php

namespace Database\Seeders;

use App\Models\ubicacion\Pais;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            'Argentina',
            'Bolivia',
            'Brasil',
            'Chile',
            'Colombia',
            'Ecuador',
            'Paraguay',
            'Perú',
            'Uruguay'
        ];

        foreach ($paises as $nombre) {
            Pais::create([
                'nombre' => $nombre
            ]);
        }
    }
}
