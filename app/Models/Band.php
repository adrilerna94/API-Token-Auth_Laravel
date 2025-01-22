<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    /** @use HasFactory<\Database\Factories\BandFactory> */
    use HasFactory;

    protected $fillable = ['band_name', 'genre', 'num_members'];

    public function concerts()
    {
        return $this->belongsToMany(Concert::class, 'concert_band', 'band_id', 'concert_id')
                    ->as('ConcertBand')
                    ->withTimestamps();
    }
}
