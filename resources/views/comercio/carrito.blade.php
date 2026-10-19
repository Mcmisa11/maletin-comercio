<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito de Compras</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-slate-900 text-white shadow-md py-4 px-6 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wider">🛒 Mi Carrito</h1>
            <a href="{{ route('comercio.index') }}" class="text-sm bg-slate-800 hover:bg-slate-700 py-2 px-4 rounded transition">
                ← Volver al Catálogo
            </a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-10 px-6">
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

        <div class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
            @if($items->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg mb-4">Aún no has añadido productos a tu carrito.</p>
                    <a href="{{ route('comercio.index') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Explorar Productos</a>
                </div>
            @else
                <table class="min-w-full mb-6">
                    <thead>
                        <tr class="border-b-2 border-gray-200 text-left text-gray-600">
                            <th class="py-3">Producto</th>
                            <th class="py-3 text-center">Precio Unitario</th>
                            <th class="py-3 text-center">Cantidad</th>
                            <th class="py-3 text-right">Subtotal</th>
                            <th class="py-3 text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="border-b border-gray-100">
                                <td class="py-4 font-bold text-gray-800">{{ $item->producto->nombre }}</td>
                                <td class="py-4 text-center">Bs {{ number_format($item->producto->precio, 2) }}</td>
                                <td class="py-4 text-center font-bold">{{ $item->cantidad }}</td>
                                <td class="py-4 text-right text-blue-700 font-bold">Bs {{ number_format($item->cantidad * $item->producto->precio, 2) }}</td>
                                <td class="py-4 text-center">
                                    <form action="{{ route('carrito.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm">❌ Quitar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex flex-col items-end border-t border-gray-200 pt-6">
                    <div class="text-2xl font-extrabold text-gray-900 mb-4">
                        Total: <span class="text-blue-700">Bs {{ number_format($total, 2) }}</span>
                    </div>
                    
                    <div class="w-full bg-slate-50 p-6 rounded-lg border border-slate-200 mt-4">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">💳 Datos de Envío y Pago (Simulado)</h3>
                        <p class="text-xs text-red-600 font-bold mb-4">
                            Seguridad PCI-DSS: Tus datos están encriptados. El CVV y el número completo NUNCA se guardan en la base de datos.
                        </p>
                        <form action="{{ route('carrito.checkout') }}" method="POST">
                            @csrf
                            
                            <!-- Opciones de Envío -->
                            <div class="mb-6 bg-white p-4 rounded border border-gray-200">
                                <h4 class="font-bold text-gray-700 mb-2">Opciones de Entrega</h4>
                                <div class="flex gap-4 mb-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="tipo_envio" value="tienda" checked onchange="document.getElementById('direccion_box').style.display='none'">
                                        <span>Recoger en Tienda (Gratis)</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="tipo_envio" value="domicilio" onchange="document.getElementById('direccion_box').style.display='block'">
                                        <span>Envío a Domicilio</span>
                                    </label>
                                </div>
                                <div id="direccion_box" style="display: none;">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Dirección Completa</label>
                                    <textarea name="direccion_envio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" rows="2" placeholder="Calle, Número, Ciudad..."></textarea>
                                </div>
                            </div>

                            <hr class="my-6">
                            <h4 class="font-bold text-gray-700 mb-2">Tarjeta de Crédito / Débito</h4>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Número de Tarjeta</label>
                                <input name="numero_tarjeta" type="text" maxlength="19" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" placeholder="1234567890123456" required>
                            </div>

                            <div class="flex gap-4 mb-6">
                                <div class="w-1/3">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Mes (MM)</label>
                                    <input name="mes_expiracion" type="text" maxlength="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" placeholder="12" required>
                                </div>
                                <div class="w-1/3">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Año (AAAA)</label>
                                    <input name="anio_expiracion" type="text" maxlength="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" placeholder="2028" required>
                                </div>
                                <div class="w-1/3">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">CVV</label>
                                    <input name="cvv" type="password" maxlength="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring" placeholder="***" required>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition text-lg">
                                    ✅ Procesar Pago y Finalizar Compra
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

</body>
</html>