<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ComercioController extends Controller
{
    // Muestra el catálogo principal
    public function index()
    {
        // Traemos todos los productos (más adelante implementaremos paginación)
        $productos = Producto::all();
        
        return view('comercio.index', compact('productos'));
    }
}