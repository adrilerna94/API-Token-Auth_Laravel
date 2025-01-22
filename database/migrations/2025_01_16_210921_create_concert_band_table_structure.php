<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*
        🤔Recordatorio: primero crear las tablas propietario y luego las relacionadas
            📌 1) Band y Concert
            📌 2) Concert_Band ➡️ tabla intermedia: ya que tiene FK que apuntan a Band y Concert
            ❓Porque? Avoid Error ➡️FK Constraint
    */
    /*
        🤔 Explicación del código:
        🔑 `foreignId('concert_id')`: Clave foránea que apunta a la tabla `concerts`
        🔧 `$table->primary(['concert_id', 'band_id'])`: PK compuesta formada por `concert_id` + `band_id`
        ❓ ¿Por qué? -> Asegura que no haya duplicados en la combinación de estos dos valores en la tabla intermedia.
        💿❌ `onDelete('cascade') / onUpdate('cascade')`: Si un `concert` o una `band` se elimina o actualiza,
            los registros correspondientes en la tabla `concert_band` se eliminarán o actualizarán automáticamente
        ☣️ Obligatorio!! ➡️ la FK de una tabla tiene que coincidir con en tipo de dato (BIGINT, autoincrement, etc)
            ➡️ foreignId la PK de la tabla referenciada 🟰 $table->id()
            🎨 $table->foreign('user_id')->references('id')->on('users'); 🟰 manual
        ✅ Esto garantiza la integridad referencial y elimina los registros huérfanos.
    */
    public function up(): void
    {
        Schema::create('concert_band', function (Blueprint $table) {

            // 📌 forma compacta ➡️ foreignId()📌

            /* Genera solo 1a llave en phpmyadmin
                ➡️ PK 🔑
                ➡️ ❓: porque el nombre FK "concert_id" en concert_band es 🟰 PK "concert_id" en concerts
            */
            $table->foreignId('concert_id')->constrained('concerts', 'concert_id')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            /* Genera 2 llaves en phpmyadmin
                ➡️ PK 🔑
                ➡️ FK 🔧 : porque el nombre band_id FK en concert_band es diferente a PK id en bands
            */
            $table->foreignId('band_id')->constrained() // asume el nombre tabla y su id con ($table->id() en bands)
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // PK compuesta (concert_id, band_id)
            $table->primary(['concert_id', 'band_id']);

            // timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concert_band');
    }
};
/*
    🤔 **Resumen sobre Claves Foráneas**:

    📌 **`foreignId()`**:
    - Forma moderna y **compacta** para crear claves foráneas.
    - Asume convenciones de Laravel, como **`<table>_id`** para la clave foránea.
    - **Automatiza** la creación de la relación **`UNSIGNED BIGINT`** con la columna **`id`** de la tabla relacionada.
    - Úsalo cuando las convenciones sean aplicables y busques **simplicidad**.

    ✨ Ejemplo:
    ```php
    $table->foreignId('band_id')->constrained()->onDelete('cascade');
    ```
    ➡️ Hace referencia a la columna **`id`** en la tabla **`bands`**.

    📌 **`foreign()`**:
    - Forma tradicional y más **flexible**.
    - Te permite definir **manualmente** las columnas de las claves foráneas y primarias,
    útil si no sigues las convenciones de Laravel.
    - **Mayor control** sobre las relaciones, especialmente en nombres personalizados de columnas.

    ✨ Ejemplo:
    ```php
    $table->foreign('band_id')->references('band_id')->on('bands')->onDelete('cascade');
    ```
    ➡️ Hace referencia a **`band_id`** en la tabla **`bands`**.

    🛠️ **Acciones**:
    - **`onDelete('cascade')`**: Elimina registros relacionados si se elimina un registro en la tabla principal.
    - **`onUpdate('cascade')`**: Actualiza automáticamente registros relacionados
    si se actualiza un registro en la tabla principal.

    👴🏼 FORMA TRADICIONAL ➡️ foreign
       1) crear columna concert_id asignandole un tipo
            $table->bigInteger('concert_id')->unsigned();
       2) Crear FK's con update y delete('cascade')
            $table->foreign('concert_id') // nombre Fk tabla concert_band
                  ->references('concert_id') // nombre PK tabla relacionada (concert_id)
                  ->on('concerts') // nombre tabla relacionada (concerts)
                  ->onUpdate('cascade') // si se actualiza un registro concert_band también en concerts
                  ->onDelete('cascade');

        // 📌 forma compacta ➡️ foreignId()📌
            $table->foreignId('concert_id')->constrained('concerts', 'concert_id')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreignId('band_id')->constrained() // asume el nombre tabla y su id con ($table->id() en bands)
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
*/
