<?php

namespace Database\Factories;

use App\Models\Band;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Band>
 */
class BandFactory extends Factory
{
    /*
     * Nombre del modelo asociado a este Factory
     * @var string
    */
    protected $model = Band::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        // Array de nombres de 10 bandas conocidas
        $bandNames =  [
            'The Beatles',
            'Red Hot Chilly Peppers',
            'Queen',
            'The Rolling Stones',
            'Pink Floyd',
            'Led Zeppelin',
            'Nirvana',
            'Metallica',
            'AC/DC',
            'The Clash',
        ];

        return [
            // Aseguramos nombre banda único y aleatorio
            'band_name' => $this->faker->unique()->randomElement($bandNames),
            'genre' => $this->faker->randomElement(['rock', 'pop', 'hip-hop', 'jazz', 'classical', 'metal']),
            'num_members' => $this->faker->numberBetWeen(2, 20), // min 2, max 20 miembros
        ];
    }
}
