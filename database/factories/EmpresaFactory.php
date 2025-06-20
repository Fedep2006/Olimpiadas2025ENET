<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition(): array
    {
        $tipos = ['hospedajes', 'viajes'];
        $tipo = fake()->randomElement($tipos);

        $nombres = [
            'hospedajes' => [
                'Hotel',
                'Resort',
                'Posada',
                'Hostal',
                'Lodge',
                'Apart Hotel',
                'Boutique Hotel'
            ],
            'viajes' => [
                'Viajes',
                'Turismo',
                'Tours',
                'Excursiones',
                'Aventuras',
                'Expediciones'
            ]
        ];

        $prefijo = fake()->randomElement($nombres[$tipo]);
        $sufijos = [
            'Premium',
            'Express',
            'Plus',
            'Elite',
            'Gold',
            'Platinum',
            'Royal',
            'Imperial',
            'del Sol',
            'Costa Azul',
            'Mar y Tierra',
            'Aventura',
            'Paradise',
            'Infinity',
            'Nacional',
            'Internacional',
            'Global',
            'Mundial',
            'Total',
            'Completo'
        ];

        $nombre = $prefijo . ' ' . fake()->randomElement($sufijos);

        return [
            'nombre' => $nombre,
            'tipo' => $tipo,
        ];
    }

    public function hospedajes(): static
    {
        return $this->state(fn(array $attributes) => [
            'tipo' => 'hospedajes',
            'nombre' => fake()->randomElement([
                'Hotel',
                'Resort',
                'Posada',
                'Hostal',
                'Lodge'
            ]) . ' ' . fake()->randomElement([
                'Premium',
                'Costa Azul',
                'del Sol',
                'Paradise',
                'Royal',
                'Imperial'
            ]),
        ]);
    }

    public function viajes(): static
    {
        return $this->state(fn(array $attributes) => [
            'tipo' => 'viajes',
            'nombre' => fake()->randomElement([
                'Viajes',
                'Turismo',
                'Tours',
                'Excursiones',
                'Aventuras'
            ]) . ' ' . fake()->randomElement([
                'Express',
                'Nacional',
                'Internacional',
                'Global',
                'Mundial'
            ]),
        ]);
    }
}
