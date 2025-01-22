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
     📌 id ➡️ $table->id() 🟰 BIGINT autoincrement PK
     📌 Nombre
     📌 Género musical: enum Rock, Pop, Hip-Hop, Jazz, Classical, Metal
     📌 Cantidad de miembros
     📌 Agregado: timestamps(): columns created_at y updated_at
     ⌛ fecha y hora de creación y de última actualización de cada registro.
    */
    public function up(): void
    {
        Schema::create('bands', function (Blueprint $table) {
            // Crear id de forma genérica
            $table->id(); // 'id' BIGINT autoincrement PK
            $table->string('band_name', 40)->unique();
            $table->enum('genre', ['rock', 'pop', 'hip-hop', 'jazz', 'classical', 'metal'])->nullable();
            $table->integer('num_members')->nullable()->unsigned(); // min 2 max 20 miembros
            $table->timestamps(); // Timestamps de created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bands');
    }
};
