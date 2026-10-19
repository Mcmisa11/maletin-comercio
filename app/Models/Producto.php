<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Producto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'imagen_url'];

    public function carritos(): HasMany
    {
        return $this->hasMany(Carrito::class);
    }
}
