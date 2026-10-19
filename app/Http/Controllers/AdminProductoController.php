<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductoController extends Controller
{
    // 1. Listar todos los productos en una tabla
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    // 2. Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        return view('admin.productos.create');
    }

    // 3. Guardar el nuevo producto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $producto = new Producto($request->all());

        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('productos', 'public');
            $producto->imagen_url = '/storage/' . $ruta;
        }

        $producto->save();

        return redirect()->route('admin.productos.index')->with('success', 'Producto registrado correctamente.');
    }

    // 4. Mostrar el formulario para editar un producto existente
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    // 5. Actualizar los datos del producto
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $producto->fill($request->except('imagen'));

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior
            if ($producto->imagen_url) {
                $ruta_relativa = str_replace('/storage/', '', $producto->imagen_url);
                Storage::disk('public')->delete($ruta_relativa);
            }
            $ruta = $request->file('imagen')->store('productos', 'public');
            $producto->imagen_url = '/storage/' . $ruta;
        }

        $producto->save();

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // 6. Eliminar un producto
    public function destroy(Producto $producto)
    {
        if ($producto->imagen_url) {
            $ruta_relativa = str_replace('/storage/', '', $producto->imagen_url);
            Storage::disk('public')->delete($ruta_relativa);
        }
        
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado.');
    }
}