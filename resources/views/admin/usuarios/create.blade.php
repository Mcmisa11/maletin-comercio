<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Crear Usuario</h2>
        <div class="bg-white p-8 rounded-xl shadow-md">
            <form action="{{ route('admin.usuarios.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <p class="font-bold mb-1">No se pudo crear el usuario:</p>
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nombre Completo</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Usuario (Login)</label>
                        <input type="text" name="username" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" class="w-full border p-2 rounded" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Contraseña</label>
                        <input type="password" name="password" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Rol del Sistema</label>
                        <select name="role_id" class="w-full border p-2 rounded" required>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ ucfirst($rol->nombre) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded w-full">Guardar Usuario</button>
            </form>
        </div>
    </div>
</body>
</html>