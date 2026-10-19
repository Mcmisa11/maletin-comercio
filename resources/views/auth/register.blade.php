<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Crear Cuenta</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre Completo</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       id="name" name="name" type="text" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Correo Electrónico</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       id="email" name="email" type="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Contraseña</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       id="password" name="password" type="password" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Confirmar Contraseña</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       id="password_confirmation" name="password_confirmation" type="password" required>
            </div>

            <!-- Captcha Anti-Bots -->
            <div class="mb-6 bg-blue-50 p-4 rounded border border-blue-200">
                <label class="block text-blue-800 text-sm font-bold mb-2" for="captcha">
                    🛡️ Verificación Humana: ¿Cuánto es {{ $captcha_question }}
                </label>
                <input class="shadow appearance-none border border-blue-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500" 
                       id="captcha" name="captcha" type="number" placeholder="Ej: 8" required>
            </div>

            <div class="flex flex-col gap-4">
                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                    Registrarse
                </button>
                <div class="text-center text-sm">
                    <span class="text-gray-600">¿Ya tienes cuenta?</span>
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-bold">Inicia Sesión</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>