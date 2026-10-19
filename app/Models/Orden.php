<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orden extends Model
{
    // Le indicamos a Laravel el nombre exacto de la tabla en español
    protected $table = 'ordenes';

    protected $fillable = ['user_id', 'estado', 'total', 'metodo_pago', 'ultimos_digitos_tarjeta', 'tipo_envio', 'direccion_envio'];

    protected $casts = [
        'direccion_envio' => 'encrypted',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}