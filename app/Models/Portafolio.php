<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portafolio extends Model
{
    // Aquí le decimos a Laravel qué campos puede llenar de golpe
    protected $fillable = [
        'nombre_completo',
        'profesion',
        'biografia',
        'ubicacion',
        'habilidades',
    ];
}