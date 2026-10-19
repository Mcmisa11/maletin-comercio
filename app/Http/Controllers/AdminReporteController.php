<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use App\Models\Orden;
use App\Models\Visita;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReporteController extends Controller
{
    // 1. Mostrar Panel de Reportes
    public function index()
    {
        $datos = [
            'total_productos' => Producto::count(),
            'total_usuarios' => User::count(),
            'clientes_registrados' => User::where('role_id', 3)->count(),
            'visitas_totales' => Visita::count(),
            'ventas_aprobadas' => Orden::where('estado', 'aprobado')->sum('total'),
            'ordenes_pendientes' => Orden::where('estado', 'pendiente')->count(),
        ];

        return view('admin.reportes.index', compact('datos'));
    }

    // 2. Exportar Reporte General a PDF
    public function pdfGeneral()
    {
        $productos = Producto::all();
        $usuarios = User::with('role')->get();
        $ventas = Orden::where('estado', 'aprobado')->with('user')->get();
        
        $pdf = Pdf::loadView('admin.reportes.pdf', compact('productos', 'usuarios', 'ventas'));
        
        return $pdf->download('Reporte_General_Sistema.pdf');
    }

    // 3. Exportar Productos a Excel (CSV)
    public function excelProductos()
    {
        $productos = Producto::all();
        $nombreArchivo = "reporte_productos_" . date('Y-m-d') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$nombreArchivo",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columnas = ['ID', 'Nombre', 'Precio (Bs)', 'Stock'];

        $callback = function() use($productos, $columnas) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columnas);

            foreach ($productos as $prod) {
                fputcsv($file, [$prod->id, $prod->nombre, $prod->precio, $prod->stock]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}