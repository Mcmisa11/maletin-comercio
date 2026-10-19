<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Maletín Digital</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">Modificar Maletín Digital</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline font-bold">← Volver al Dashboard</a>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
            <form action="{{ route('admin.portafolio.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre Completo</label>
                        <input type="text" name="nombre_completo" value="{{ $perfil->nombre_completo }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Profesión</label>
                        <input type="text" name="profesion" value="{{ $perfil->profesion }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Biografía</label>
                    <textarea name="biografia" rows="4" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $perfil->biografia }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Ubicación</label>
                        <input type="text" name="ubicacion" value="{{ $perfil->ubicacion }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Habilidades Técnicas (separadas por coma)</label>
                        <input type="text" name="habilidades" value="{{ $habilidades_texto }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">URL de GitHub (Opcional)</label>
                        <input type="url" name="github_url" value="{{ $perfil->github_url }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">URL de LinkedIn (Opcional)</label>
                        <input type="url" name="linkedin_url" value="{{ $perfil->linkedin_url }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mb-8 border-t pt-6">
                    <label class="block text-gray-700 font-bold mb-2">Foto de Perfil (Opcional - Reemplazará la actual)</label>
                    <input type="file" name="foto_perfil" accept="image/*" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition shadow-md">
                        💾 Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>