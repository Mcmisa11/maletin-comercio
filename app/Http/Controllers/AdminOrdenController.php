<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;

class AdminOrdenController extends Controller
{
    // 1. Mostrar todas las órdenes de compra solicitadas
    public function index()
    {
        // Traemos las órdenes junto con los datos del usuario que las creó, ordenadas por las más recientes
        $ordenes = Orden::with('user')->orderBy('created_at', 'desc')->get();
        
        return view('admin.ordenes.index', compact('ordenes'));
    }

    // 2. Actualizar el estado de la orden (Aprobar o Rechazar)
    public function updateStatus(Request $request, Orden $orden)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,aprobado,rechazado'
        ]);

        $orden->estado = $request->estado;
        $orden->save();

        return redirect()->route('admin.ordenes.index')->with('success', 'El estado de la solicitud #'.$orden->id.' ha sido actualizado a: ' . strtoupper($request->estado));
    }
}