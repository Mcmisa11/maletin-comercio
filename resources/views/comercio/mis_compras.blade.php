<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-slate-900 text-white shadow-md py-4 px-6 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wider">📦 Mis Compras</h1>
            <div class="flex gap-4">
                <a href="{{ route('comercio.index') }}" class="text-sm bg-slate-800 hover:bg-slate-700 py-2 px-4 rounded transition">
                    Ver Catálogo
                </a>
                <a href="{{ route('carrito.index') }}" class="text-sm bg-blue-600 hover:bg-blue-500 py-2 px-4 rounded transition">
                    🛒 Mi Carrito
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto py-10 px-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 font-bold shadow">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Historial de Pedidos</h2>

        @if($ordenes->isEmpty())
            <div class="bg-white p-10 rounded-xl shadow border border-gray-200 text-center">
                <p class="text-gray-500 text-lg mb-4">Aún no has realizado ninguna compra.</p>
                <a href="{{ route('comercio.index') }}" class="bg-blue-600 text-white font-bold py-2 px-6 rounded hover:bg-blue-700">Explorar Productos</a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($ordenes as $orden)
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 hover:shadow-md transition">
                        
                        <!-- Detalles de la Orden -->
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="font-bold text-gray-800 text-lg">Orden #{{ str_pad($orden->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span class="text-sm text-gray-500">{{ $orden->created_at->format('d M Y - H:i') }}</span>
                            </div>
                            
                            <div class="text-gray-600 text-sm mb-2">
                                <strong>Total Pagado:</strong> <span class="text-blue-700 font-bold">Bs {{ number_format($orden->total, 2) }}</span>
                            </div>

                            <div class="bg-slate-50 p-3 rounded border border-slate-100 text-sm">
                                <p><strong>Envío:</strong> {{ $orden->tipo_envio === 'domicilio' ? 'A Domicilio' : 'Recoger en Tienda' }}</p>
                                @if($orden->tipo_envio === 'domicilio')
                                    <p class="text-gray-500">📍 {{ $orden->direccion_envio }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Estado de la Orden -->
                        <div class="w-full md:w-auto text-right">
                            @if($orden->estado === 'pendiente')
                                <span class="inline-block bg-yellow-100 text-yellow-800 border border-yellow-300 font-bold py-2 px-4 rounded-full text-sm">
                                    ⏳ Pendiente de Aprobación
                                </span>
                                <p class="text-xs text-gray-500 mt-2">Un técnico está revisando el pago.</p>
                            @elseif($orden->estado === 'aprobado')
                                <span class="inline-block bg-green-100 text-green-800 border border-green-300 font-bold py-2 px-4 rounded-full text-sm">
                                    ✅ Orden Aprobada
                                </span>
                                <p class="text-xs text-gray-500 mt-2">Tu pedido está listo / en camino.</p>
                            @elseif($orden->estado === 'rechazado')
                                <span class="inline-block bg-red-100 text-red-800 border border-red-300 font-bold py-2 px-4 rounded-full text-sm">
                                    ❌ Orden Rechazada
                                </span>
                                <p class="text-xs text-gray-500 mt-2">Hubo un problema con tu pago o stock.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
