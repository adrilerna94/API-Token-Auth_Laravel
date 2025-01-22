<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concert>
 */
class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $legendaryConcerts = [
            'The Beatles - Shea 65',
            'The Beatles - Ed Sullivan',
            'Red Hot Chili Peppers - Slane 03',
            'Red Hot Chili Peppers - Woodstock 99',
            'Queen - Live Aid 85',
            'Queen - Earls Court 77',
            'The Rolling Stones - Altamont 69',
            'The Rolling Stones - Tokyo 90',
            'Pink Floyd - The Wall 81',
            'Pink Floyd - Pompeii 72',
            'Led Zeppelin - MSG 73',
            'Led Zeppelin - O2 07',
            'Nirvana - MTV Unplugged',
            'Nirvana - Reading 92',
            'Metallica - Moscow 91',
            'Metallica - Mexico 93',
            'AC/DC - Donington 91',
            'AC/DC - River Plate 09',
            'The Clash - The Roxy 76',
            'The Clash - Shea 82',
        ];
        /*
            randomDate = $faker->dateTimeThisDecade();
            $formattedDate = $randomDate->format('Y-m-d H:i:s');  // Convierte al formato timestamp de MySQL
        */
        // Generar start_date con Faker
        $start_date = $this->faker->dateTimeThisDecade();

        // Modificar end_date sumando un máximo de 7 días
        $end_date = clone $start_date;  // Hacemos una copia del objeto DateTime
        $end_date->modify('+7 days');  // Sumamos 7 días

        // Convertir a formato MySQL (YYYY-MM-DD HH:MM:SS)
        $start_date_format = $start_date->format('Y-m-d H:i:s');
        $end_date_format = $end_date->format('Y-m-d H:i:s');

        return [
            'name' => $this->faker->unique()->randomElement($legendaryConcerts),
            'start_date' => $start_date_format,
            'end_date' => $end_date_format,
            'capacity' => $this->faker->numberBetween(10000, 5000000),
            'tickets_sold' => $this->faker->numberBetween(0, 5000000),
        ];
    }
}
