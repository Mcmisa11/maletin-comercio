<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerencia - Auditorías y Seguridad</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <!-- Menú Lateral -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-slate-700">
            <h2 class="text-lg font-bold">Panel de Control</h2>
        </div>
        
        <div class="p-4 flex flex-col gap-2 flex-grow">
            <p class="text-xs text-slate-400 uppercase font-bold mb-2">Gestión</p>
            
            <a href="{{ route('admin.portafolio.edit') }}" class="text-slate-300 px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-800 hover:text-white transition">
                💼 Editar Maletín
            </a>
            <a href="{{ route('admin.productos.index') }}" class="text-slate-300 px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-800 hover:text-white transition">
                📦 Productos
            </a>
            <a href="{{ route('admin.ordenes.index') }}" class="text-slate-300 px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-800 hover:text-white transition">
                🛒 Solicitudes de Compra
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="text-slate-300 px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-800 hover:text-white transition">
                👥 Usuarios y Roles
            </a>

            @if(Auth::user()->isAdmin())
                <p class="text-xs text-slate-400 uppercase font-bold mt-4 mb-2">Gerencia</p>
                <a href="{{ route('admin.reportes.index') }}" class="text-slate-300 px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-800 hover:text-white transition">
                    📊 Reportes (PDF/Excel)
                </a>
                <a href="{{ route('admin.gerencia.index') }}" class="bg-slate-800 text-white px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-700 transition">
                    🛡️ Auditorías y Seguridad
                </a>
            @endif
        </div>

        <div class="p-4 border-t border-slate-700">
            <div class="text-sm mb-2 text-slate-300">
                Usuario: <span class="font-bold text-white">{{ Auth::user()->name }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded transition">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-16 bg-white shadow-sm flex items-center px-6 justify-between border-b border-gray-200">
            <h1 class="text-xl font-semibold text-gray-800">Gerencia - Auditorías y Seguridad</h1>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline text-sm font-medium">Ver sitio público</a>
        </header>

        <div class="p-8 space-y-8">
            
            <!-- Intentos Fallidos -->
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200 bg-red-50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-red-800">⚠️ Intentos de Inicio de Sesión Fallidos</h3>
                    <span class="bg-red-200 text-red-800 text-xs px-2 py-1 rounded font-bold">{{ count($failedLogins) }} registros</span>
                </div>
                <div class="overflow-x-auto max-h-96">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-700 sticky top-0">
                            <tr>
                                <th class="px-6 py-3">Fecha y Hora</th>
                                <th class="px-6 py-3">Correo Intentado</th>
                                <th class="px-6 py-3">Dirección IP</th>
                                <th class="px-6 py-3">Intento #</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($failedLogins as $login)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $login['timestamp'] ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-red-600 font-medium">{{ $login['login_intentado'] ?? 'N/A' }}</td>
                                <td class="px-6 py-4 font-mono text-gray-500">{{ $login['ip'] ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $login['intentos'] ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay registros de intentos fallidos.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Auditoría de Cambios -->
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200 bg-blue-50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-blue-800">📝 Auditoría de Cambios en Base de Datos</h3>
                    <span class="bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded font-bold">{{ $audits->count() }} registros</span>
                </div>
                <div class="overflow-x-auto max-h-96">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-700 sticky top-0">
                            <tr>
                                <th class="px-6 py-3">Fecha</th>
                                <th class="px-6 py-3">Usuario</th>
                                <th class="px-6 py-3">Acción</th>
                                <th class="px-6 py-3">Módulo (Modelo)</th>
                                <th class="px-6 py-3">Valores Anteriores</th>
                                <th class="px-6 py-3">Valores Nuevos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($audits as $audit)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $audit->created_at }}</td>
                                <td class="px-6 py-4 font-medium">{{ $audit->user ? $audit->user->name : 'Sistema/Desconocido' }}</td>
                                <td class="px-6 py-4">
                                    @if($audit->event === 'created') <span class="text-green-600 font-bold">Creado</span> @endif
                                    @if($audit->event === 'updated') <span class="text-yellow-600 font-bold">Actualizado</span> @endif
                                    @if($audit->event === 'deleted') <span class="text-red-600 font-bold">Eliminado</span> @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ class_basename($audit->auditable_type) }} (ID: {{ $audit->auditable_id }})</td>
                                <td class="px-6 py-4">
                                    <div class="max-h-20 overflow-y-auto text-xs font-mono bg-gray-100 p-2 rounded">
                                        @foreach($audit->old_values as $key => $value)
                                            <span class="text-red-500">- {{ $key }}:</span> {{ is_array($value) ? json_encode($value) : $value }}<br>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-h-20 overflow-y-auto text-xs font-mono bg-gray-100 p-2 rounded">
                                        @foreach($audit->new_values as $key => $value)
                                            <span class="text-green-500">+ {{ $key }}:</span> {{ is_array($value) ? json_encode($value) : $value }}<br>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay registros de auditoría aún.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
