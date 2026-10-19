<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Solicitudes</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto py-10 px-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-extrabold text-gray-800">🛒 Solicitudes de Compra</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:underline font-bold">← Volver al Dashboard</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-slate-900 text-white">
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">ID Solicitud</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Cliente</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Total</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Estado Actual</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold uppercase tracking-wider">Acciones (Técnico/Admin)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordenes as $orden)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-gray-900">
                                #{{ str_pad($orden->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="font-bold text-gray-800">{{ $orden->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $orden->user->email }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-extrabold text-blue-700">
                                Bs {{ number_format($orden->total, 2) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                @if($orden->estado == 'pendiente')
                                    <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs font-bold uppercase">Pendiente</span>
                                @elseif($orden->estado == 'aprobado')
                                    <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold uppercase">Aprobado</span>
                                @else
                                    <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold uppercase">Rechazado</span>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <form action="{{ route('admin.ordenes.update_status', $orden->id) }}" method="POST" class="inline-flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    
                                    <button type="submit" name="estado" value="aprobado" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs transition {{ $orden->estado == 'aprobado' ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $orden->estado == 'aprobado' ? 'disabled' : '' }}>
                                        Aprobar
                                    </button>
                                    
                                    <button type="submit" name="estado" value="rechazado" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs transition {{ $orden->estado == 'rechazado' ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $orden->estado == 'rechazado' ? 'disabled' : '' }}>
                                        Rechazar
                                    </button>
                                    
                                    <button type="submit" name="estado" value="pendiente" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded text-xs transition {{ $orden->estado == 'pendiente' ? 'hidden' : '' }}">
                                        Revertir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-5 text-center text-gray-500">No hay solicitudes de compra registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>