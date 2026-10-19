<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    // Permitimos la asignación masiva de estos dos campos
    protected $fillable = ['ip_address', 'fecha'];
}