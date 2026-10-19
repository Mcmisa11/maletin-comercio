<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-slate-700">
            <h2 class="text-lg font-bold">Panel de Control</h2>
        </div>
        
        <div class="p-4 flex flex-col gap-2 flex-grow">
            <p class="text-xs text-slate-400 uppercase font-bold mb-2">Gestión</p>
            
            <a href="{{ route('admin.portafolio.edit') }}" class="bg-slate-800 text-white px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-700 transition">
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
                <a href="{{ route('admin.gerencia.index') }}" class="text-slate-300 px-4 py-2 rounded flex items-center gap-2 hover:bg-slate-800 hover:text-white transition">
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
            <h1 class="text-xl font-semibold text-gray-800">Bienvenido al área de administración</h1>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline text-sm font-medium">Ver sitio público</a>
        </header>

        <div class="p-8">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Resumen del Sistema</h3>
                <p class="text-gray-600 mb-4">Selecciona una opción del menú lateral para comenzar a administrar la base de datos.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-blue-50 border border-blue-100 p-4 rounded-lg">
                        <h4 class="font-bold text-blue-800 text-xl">Tu Perfil</h4>
                        <p class="text-sm text-blue-600 mt-1">Nivel de Acceso: <strong>{{ strtoupper(Auth::user()->role->nombre) }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>