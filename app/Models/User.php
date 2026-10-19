<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use Notifiable, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Un usuario pertenece a un rol
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Un usuario puede tener muchos productos en su carrito
    public function carritos(): HasMany
    {
        return $this->hasMany(Carrito::class);
    }

    // Un usuario puede tener muchas órdenes de compra
    public function ordenes(): HasMany
    {
        return $this->hasMany(Orden::class);
    }

    // Funciones de ayuda para verificar roles fácilmente en las vistas o rutas
    public function isAdmin(): bool
    {
        return $this->role->nombre === 'administrador';
    }

    public function isTecnico(): bool
    {
        return $this->role->nombre === 'tecnico';
    }

    public function isInvitado(): bool
    {
        return $this->role->nombre === 'invitado';
    }
}