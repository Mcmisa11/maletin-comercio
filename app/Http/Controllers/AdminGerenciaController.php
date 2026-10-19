<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\File;

class AdminGerenciaController extends Controller
{
    public function index()
    {
        // 1. Obtener Intentos Fallidos de Inicio de Sesión
        $logFile = storage_path('logs/laravel.log');
        $failedLogins = [];

        if (File::exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, 'Intento de inicio de sesión fallido') !== false) {
                    preg_match('/\{(.*?)\}/', $line, $matches);
                    if (!empty($matches[0])) {
                        $failedLogins[] = json_decode($matches[0], true);
                    }
                }
            }
        }
        
        // Ordenar los más recientes primero
        $failedLogins = array_reverse($failedLogins);

        // 2. Obtener las Auditorías (Cambios realizados y por quién)
        $audits = Audit::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.gerencia.index', compact('failedLogins', 'audits'));
    }
}
