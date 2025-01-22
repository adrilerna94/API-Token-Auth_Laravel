<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Band;

class BandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 10 bandas de música aleatorias
        Band::factory(10)->create();
    }
}
// php artisan migrate:fresh --seed
/*
    📌 migrate:fresh: Elimina todas las tablas en la base de datos
       y luego ejecuta todas las migraciones para volver a crear las tablas desde cero.

   ➡️ --seed: Después de ejecutar las migraciones, ejecutará todos los seeders definidos en DatabaseSeeder.php.

*/
