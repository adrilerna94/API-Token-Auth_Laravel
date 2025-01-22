<?php

// 🖥️ php artisan make:migration create_concerts_table_structure --table=concerts

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ➡️  Nombre
     * ➡️  Día y hora de inicio: timestamp (fecha y hora) / date (solo fecha)
     * ➡️  Día y hora de fin : maximo 7 días de concierto
     * ➡️  Número máximo de personas
     * ➡️  Número de entradas vendidas
     */
    public function up(): void
    {
        Schema::create('concerts', function (Blueprint $table) {

            // PK 'concert_id' BIGINT SIN SIGNO  autoincremental
           // $table->bigInteger('concert_id')->unsigned()->primary()->increments();

            // ⚡Forma compacta ⚡ BIGINT - UNSIGNED- PK
            $table->bigIncrements('concert_id');

            // La columna 'name' es única, pero no es la clave primaria
            $table->string('name', 50)->nullable(false)->unique();

            // La columna 'start_date' con valor predeterminado como fecha y hora actual
            $table->timestamp('start_date')->useCurrent(); // useCurrent() : Default timestamp actual

            // La columna 'end_date' con valor predeterminado como fecha y hora actual
            $table->timestamp('end_date')->useCurrent(); // obligatorio valor default timestamp

            // Capacidad del concierto con valor por defecto
            $table->integer('capacity')->default(10000)->unsigned(); // con default no necesario indicar nullable()

            // Número de entradas vendidas, solo valores positivos
            $table->integer('tickets_sold')->unsigned(); // unsigned() ➡️ valores + positivos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la tabla 'concerts'
        Schema::dropIfExists('concerts');
    }
};

   /*
    * 📝 **Schema::create** vs **Schema::table** in Laravel
    *
    * **Schema::create** ➡️ Crea una **nueva tabla** en la base de datos.
    *
    * ✅ Uso:
    * - Se usa cuando necesitas **crear una tabla desde cero**.
    *
    * 🔧 Ejemplo:
    * ```php
    * Schema::create('concerts', function (Blueprint $table) {
    *     $table->id();
    *     $table->string('name');
    *     $table->timestamp('start_date')->useCurrent();
    *     $table->timestamps();
    * });
    * ```
    *
    * **Schema::table** ➡️ Modifica una **tabla existente**.
    *
    * ✅ Uso:
    * - Se usa cuando necesitas **modificar** una tabla que ya existe: agregar, eliminar o cambiar columnas.
    *
    * 🔧 Ejemplo:
    * ```php
    * Schema::table('concerts', function (Blueprint $table) {
    *     $table->string('location')->nullable();  // Agregar columna
    *     $table->dropColumn('tickets_sold');      // Eliminar columna
    *     $table->integer('capacity')->default(5000)->unsigned();  // Modificar columna
    * });
    * ```
    *
    * 🚀 **Resumen**:
    * - **`Schema::create`** ➡️ **Crear nuevas tablas**.
    * - **`Schema::table`** ➡️ **Modificar tablas existentes**.
    *
    * ✔️ ¡Usa cada uno según lo que necesites hacer en la base de datos!
    */
/*
// Eliminar columnas específicas

Schema::table('concerts', function (Blueprint $table) {
            // eliminar varias columnas a la vez
            $table->dropColumn([
                'name',
                'start_date',
                'end_date',
                'capacity',
                'tickets_sold'
            ]);
        });



*/
