<?php

namespace App\Http\Controllers;

use App\Models\Portafolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Visita;

class PortafolioController extends Controller
{
    // Muestra la página principal (Maletín Digital)
    public function index(Request $request)
    {
        // REGISTRO DE VISITA: Guarda la IP y la fecha (si entra 2 veces el mismo día, cuenta como 1 visita única por IP)
        Visita::firstOrCreate([
            'ip_address' => $request->ip(),
            'fecha' => now()->toDateString(),
        ]);

        $perfil = Portafolio::first();
        // Obtenemos el primer registro del portafolio (el tuyo creado en el Seeder)
        $perfil = Portafolio::first();

        // Si por alguna razón no hay datos, enviamos un objeto vacío para evitar errores
        if (!$perfil) {
            $perfil = new Portafolio([
                'nombre_completo' => 'Nombre no registrado',
                'profesion' => 'Desarrollador',
                'biografia' => 'Sin biografía disponible.',
                'ubicacion' => 'No especificada',
                'habilidades' => json_encode([]),
            ]);
        }

        // Decodificamos el JSON de habilidades a un array de PHP
        $habilidades = json_decode($perfil->habilidades, true) ?? [];

        return view('maletin', compact('perfil', 'habilidades'));
    }
    public function edit()
    {
        $perfil = Portafolio::first();
        // Convertimos el array de habilidades en texto separado por comas para el formulario
        $habilidades_texto = implode(', ', json_decode($perfil->habilidades, true) ?? []);
        
        return view('admin.portafolio_edit', compact('perfil', 'habilidades_texto'));
    }

    // Recibe los datos del formulario y actualiza la base de datos
    public function update(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'profesion' => 'required|string|max:255',
            'biografia' => 'required|string',
            'ubicacion' => 'required|string|max:255',
            'habilidades' => 'required|string', // Se espera texto separado por comas
            'github_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Máximo 2MB
        ]);

        $perfil = Portafolio::first();

        // Procesar las habilidades (de texto separado por comas a formato JSON)
        $habilidades_array = array_map('trim', explode(',', $request->habilidades));

        // Procesar la imagen si el usuario subió una nueva
        if ($request->hasFile('foto_perfil')) {
            // Eliminar foto anterior si existe
            if ($perfil->foto_perfil && Storage::exists('public/' . $perfil->foto_perfil)) {
                Storage::delete('public/' . $perfil->foto_perfil);
            }
            // Guardar nueva foto
            $ruta_imagen = $request->file('foto_perfil')->store('perfil', 'public');
            $perfil->foto_perfil = $ruta_imagen;
        }

        // Actualizar el resto de los campos
        $perfil->nombre_completo = $request->nombre_completo;
        $perfil->profesion = $request->profesion;
        $perfil->biografia = $request->biografia;
        $perfil->ubicacion = $request->ubicacion;
        $perfil->habilidades = json_encode($habilidades_array);
        $perfil->github_url = $request->github_url;
        $perfil->linkedin_url = $request->linkedin_url;
        $perfil->save();

        return redirect()->route('admin.dashboard')->with('success', 'Maletín digital actualizado correctamente.');
    }
}