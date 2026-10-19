<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Acceso al Sistema</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="login">
                    Usuario o Correo Electrónico
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       id="login" name="login" type="text" placeholder="Ej: admin1 o misael@carvajal.com" value="{{ old('login') }}" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Contraseña
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
                       id="password" name="password" type="password" placeholder="********" required>
            </div>

            @if(isset($requireCaptcha) && $requireCaptcha)
                <!-- Captcha Anti-Bots tras 3 intentos fallidos -->
                <div class="mb-6 bg-red-50 p-4 rounded border border-red-200">
                    <p class="text-sm text-red-600 mb-2 font-bold">Demasiados intentos. Verificación requerida.</p>
                    <label class="block text-red-800 text-sm font-bold mb-2" for="captcha">
                        🛡️ ¿Cuánto es {{ $captcha_question }}
                    </label>
                    <input class="shadow appearance-none border border-red-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-red-500" 
                           id="captcha" name="captcha" type="number" placeholder="Ej: 8" required>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                    Ingresar
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="/" class="text-sm text-gray-500 hover:text-gray-800">← Volver al inicio</a>
        </div>
    </div>

</body>
</html>