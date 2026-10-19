<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes Gerenciales</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto py-10 px-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">📊 Reportes del Sistema</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:underline font-bold mt-2">← Volver al Dashboard</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
                <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Visitas a la Página</h3>
                <p class="text-3xl font-black text-gray-800 mt-2">{{ $datos['visitas_totales'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500">
                <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Ventas Aprobadas</h3>
                <p class="text-3xl font-black text-green-600 mt-2">Bs {{ number_format($datos['ventas_aprobadas'], 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500">
                <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Clientes Registrados</h3>
                <p class="text-3xl font-black text-gray-800 mt-2">{{ $datos['clientes_registrados'] }} / {{ $datos['total_usuarios'] }} total</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-md">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Exportar Datos</h3>
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('admin.reportes.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded shadow flex items-center justify-center gap-2">
                    📄 Descargar Reporte Completo (PDF)
                </a>
                <a href="{{ route('admin.reportes.excel') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded shadow flex items-center justify-center gap-2">
                    📊 Exportar Inventario (Excel / CSV)
                </a>
            </div>
        </div>
    </div>
</body>
</html>