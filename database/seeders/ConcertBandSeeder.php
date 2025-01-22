<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Concert;
use App\Models\Band;

class ConcertBandSeeder extends Seeder
{
    public function run()
    {
        // 🎤 Obtener todos los conciertos previamente creados
        $concerts = Concert::all();

        // 🎸 Obtener todas las bandas previamente creadas
        $bands = Band::all();

        // ⚠️ Verificar si no hay conciertos o bandas disponibles
        if ($concerts->isEmpty() || $bands->isEmpty()) {
            // 📢 Si no hay datos, ejecutar los seeders de Concert y Band
            $this->call(ConcertSeeder::class);
            $this->call(BandSeeder::class);

            // 🔄 Volver a obtener los conciertos y bandas después de ejecutar los seeders
            $concerts = Concert::all();
            $bands = Band::all();
        }

        // 🎶 Para cada concierto, asignar entre 1 y 3 bandas aleatorias
        foreach ($concerts as $concert) {
            // 🎧 Seleccionar entre 1 y 3 bandas aleatorias para este concierto
            $selectedBands = $bands->random(rand(1, 3));

            // 🔗 Conectar el concierto con las bandas seleccionadas usando la relación muchos a muchos
            // 👇 'pluck' extrae solo los IDs de las bandas seleccionadas
            // 🎗️ 'attach' las agrega a la tabla intermedia 'concert_band'
            $concert->bands()->attach($selectedBands->pluck('id')->toArray());
        }
    }
}
