<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Si el usuario no ha iniciado sesión, lo mandamos al login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['login' => 'Debes iniciar sesión para acceder.']);
        }

        // Obtenemos el nombre del rol del usuario actual
        $userRole = Auth::user()->role->nombre;

        // Verificamos si su rol está dentro de la lista de roles permitidos para esta ruta
        if (!in_array($userRole, $roles)) {
            // Si es un cliente intentando entrar al panel, lo regresamos al comercio
            return redirect()->route('comercio.index')->withErrors(['acceso' => 'No tienes permisos de administrador o técnico.']);
        }

        return $next($request);
    }
}