<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto py-10 px-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">👥 Gestión de Usuarios</h2>
            <div class="flex gap-4">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:underline font-bold mt-2">← Volver al Dashboard</a>
                <a href="{{ route('admin.usuarios.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                    + Nuevo Usuario
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-slate-900 text-white">
                        <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold uppercase">Nombre</th>
                        <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold uppercase">Usuario / Email</th>
                        <th class="px-5 py-3 border-b-2 text-left text-xs font-semibold uppercase">Rol</th>
                        <th class="px-5 py-3 border-b-2 text-center text-xs font-semibold uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-gray-900">
                                {{ $user->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-800 font-semibold">{{ $user->username ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="bg-gray-100 text-gray-700 py-1 px-3 rounded-full text-xs font-bold uppercase">
                                    {{ $user->role->nombre }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900 font-bold mr-3">Editar</a>
                                <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>