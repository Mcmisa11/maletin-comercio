<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">Crear Nuevo Producto</h2>
            <a href="{{ route('admin.productos.index') }}" class="text-blue-600 hover:underline font-bold">← Volver a la lista</a>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Nombre del Producto</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <textarea name="descripcion" rows="4" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('descripcion') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Precio (Bs)</label>
                        <input type="number" step="0.01" min="0" name="precio" value="{{ old('precio') }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Stock Disponible</label>
                        <input type="number" min="0" name="stock" value="{{ old('stock') }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="mb-8 border-t pt-6">
                    <label class="block text-gray-700 font-bold mb-2">Imagen del Producto</label>
                    <input type="file" name="imagen" accept="image/*" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition shadow-md">
                        + Guardar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>