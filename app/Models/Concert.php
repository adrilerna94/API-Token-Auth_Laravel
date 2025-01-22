<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    /** @use HasFactory<\Database\Factories\ConcertFactory> */
    use HasFactory;

    /*
        🎯 ¿Por qué es necesario especificar la clave primaria en el modelo?
        ✅ Aunque en la migración se haya definido 'concert_id' como la clave primaria,
            ➡️ **Eloquent** no sabe automáticamente que esta columna es la clave primaria,
            ➡️ a menos que se le indique explícitamente.
     */
    protected $primaryKey = 'concert_id';
    protected $fillable = ['name', 'start_date', 'end_date', 'capacity', 'tickets_sold'];

    // solo se puede hacer desde la migración.
    // ya que las columnas updated at y created at son automáticas
    public $timestamps = false;

    public function bands()
    {

        return $this->belongsToMany(Band::class, 'concert_band', 'concert_id', 'band_id')
                    ->as('ConcertBand') // en vez de pivot se llamará ConcertBand
                    ->withTimestamps(); // created at updated at (timestamps columnas) aparecerán
                    // default: solo las FK Y PK aparecen en la tabla intermedia (pivot por default)
    }
}

/*
  🎯 ¿Por qué es necesario especificar la clave primaria en el modelo?

  ✅ Aunque en la migración se haya definido 'concert_id' como la clave primaria,
     **Eloquent** no sabe automáticamente que esta columna es la clave primaria,
     a menos que se le indique explícitamente.

  🔍 **Convención de Laravel**:
     - Laravel asume que la clave primaria se llama **'id'** por defecto en las tablas.
     - **Eloquent** utiliza esta convención para realizar consultas y gestionar relaciones.

     Si cambias el nombre de la clave primaria (como en 'concert_id'), debes decirle a Eloquent
     cuál es la clave primaria personalizada para que funcione correctamente.

  🔑 **¿Por qué es importante?**
     - Eloquent necesita saber qué columna usar como la **clave primaria** cuando realiza
       operaciones como **consultas**, **actualizaciones**, y **relaciones** entre tablas.
     - Si no le indicas la clave primaria correcta, **Eloquent** intentará usar la columna
       predeterminada **'id'** y las relaciones pueden fallar.

  📌 **En resumen**:
     - Si la clave primaria no se llama **'id'**, debes configurarlo en el modelo para evitar
       conflictos en las relaciones y en la manipulación de datos.

  🔧 **Cómo hacerlo**:
     - En el modelo `Concert`, debes especificar la propiedad `$primaryKey` como 'concert_id'.
     - Esto asegura que **Eloquent** utilice correctamente **'concert_id'** como la clave primaria.

  Ejemplo en el modelo Concert:
  // protected $primaryKey = 'concert_id';  // Especifica que la clave primaria es 'concert_id'
*/
