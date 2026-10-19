<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo del Negocio</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-slate-900 text-white shadow-md py-4 px-6 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-slate-300 hover:text-white transition text-sm bg-slate-800 px-3 py-1 rounded-full">← Volver</a>
                <h1 class="text-2xl font-bold tracking-wider text-white">🏪 Tienda de Barrio</h1>
                <span class="text-sm font-medium bg-blue-600 text-white px-3 py-1 rounded-full shadow-inner hidden md:inline-block">Catálogo de Productos</span>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm bg-slate-800 py-1 px-3 rounded-md border border-slate-700">
                        {{ Auth::user()->name }} 
                        <span class="text-green-400 font-bold text-xs uppercase ml-1">[{{ Auth::user()->role->nombre }}]</span>
                    </span>

                    @if(Auth::user()->isInvitado())
                        <a href="{{ route('carrito.mis_compras') }}" class="text-white hover:text-blue-300 font-semibold text-sm transition">
                            📦 Mis Compras
                        </a>
                        <a href="{{ route('carrito.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-slate-900 font-bold py-2 px-4 rounded text-sm transition ml-2">
                            🛒 Mi Carrito
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                            ⚙️ Panel de Control
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-400 hover:text-red-300 transition">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm hover:text-gray-300 transition">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg text-sm font-bold transition shadow-sm">
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-6xl mx-auto px-6 py-8 w-full">
        <div class="mb-8 border-b border-gray-300 pb-4">
            <h2 class="text-3xl font-extrabold text-gray-800">Nuestros Productos</h2>
            <p class="text-gray-600 mt-2">Explora nuestro catálogo. 
                @guest Regístrate para poder realizar solicitudes de compra. @endguest
            </p>
        </div>

        @if($productos->isEmpty())
            <div class="bg-white p-8 rounded-lg shadow-sm text-center border border-gray-200">
                <p class="text-gray-500 text-lg">Actualmente no hay productos registrados en la base de datos.</p>
                @auth
                    @if(!Auth::user()->isInvitado())
                        <p class="mt-4 text-sm text-blue-600">Ve al panel de control para añadir el primer producto.</p>
                    @endif
                @endauth
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($productos as $producto)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition flex flex-col">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            @if($producto->imagen_url)
                                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 text-4xl">📦</span>
                            @endif
                        </div>
                        
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $producto->nombre }}</h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $producto->descripcion }}</p>
                            </div>
                            
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <span class="text-xl font-extrabold text-blue-700">Bs {{ number_format($producto->precio, 2) }}</span>
                                <span class="text-xs font-semibold px-2 py-1 bg-gray-100 text-gray-600 rounded">Stock: {{ $producto->stock }}</span>
                            </div>

                            @auth
                                @if(Auth::user()->isInvitado())
                                    <form action="{{ route('carrito.add', $producto->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="mt-4 w-full bg-green-50 text-green-700 border border-green-200 font-bold py-2 px-4 rounded hover:bg-green-600 hover:text-white transition text-sm">
                                            + Añadir al Carrito
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>