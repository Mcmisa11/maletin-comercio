<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function showLogin()
    {
        $attempts = session()->get('login_attempts', 0);
        $requireCaptcha = $attempts >= 3;
        $captcha_question = null;

        if ($requireCaptcha) {
            $captcha = $this->generateCaptcha();
            session(['login_captcha_answer' => $captcha['answer']]);
            $captcha_question = $captcha['question'];
        }

        return view('auth.login', compact('requireCaptcha', 'captcha_question'));
    }

    // Muestra el formulario de registro
    public function showRegister()
    {
        $captcha = $this->generateCaptcha();
        session(['captcha_answer' => $captcha['answer']]);
        $captcha_question = $captcha['question'];

        return view('auth.register', compact('captcha_question'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Requiere campo password_confirmation
            'captcha' => 'required|numeric|in:' . session('captcha_answer'),
        ], [
            'captcha.in' => 'El resultado matemático (Captcha) es incorrecto.',
            'captcha.required' => 'Por favor, resuelve el problema matemático para verificar que eres humano.'
        ]);

        // Sanitización adicional (Punto 7)
        $nombreSanitizado = trim(strip_tags($request->name));

        // Se crea el usuario forzando el role_id a 3 (Invitado) por seguridad
        $user = User::create([
            'name' => $nombreSanitizado,
            'email' => $request->email,
            'username' => null, // El cliente público solo usa email por ahora
            'password' => Hash::make($request->password),
            'role_id' => 3, 
        ]);

        // Iniciamos sesión automáticamente tras el registro
        Auth::login($user);

        return redirect()->route('comercio.index')->with('success', 'Cuenta creada con éxito. Bienvenido al catálogo.');
    }
    // Procesa el intento de inicio de sesión
    public function login(Request $request)
    {
        $attempts = session()->get('login_attempts', 0);
        $rules = [
            'login' => 'required|string', // Aquí puede viajar el email o el username
            'password' => 'required|string',
        ];

        // Exigir Captcha si ha fallado 3 o más veces
        if ($attempts >= 3) {
            $rules['captcha'] = 'required|numeric|in:' . session('login_captcha_answer');
        }

        $credentials = $request->validate($rules, [
            'captcha.in' => 'El resultado matemático (Captcha) es incorrecto.',
            'captcha.required' => 'Por favor, resuelve el problema matemático para verificar que eres humano.'
        ]);

        // Determinar si el campo "login" es un email o un nombre de usuario
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Intentar autenticar al usuario
        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
            // Borrar los intentos de sesión fallidos si ingresa correctamente
            session()->forget('login_attempts');

            // Redireccionar temporalmente a la página principal tras un login exitoso
            return redirect()->intended('/')->with('success', '¡Bienvenido de nuevo!');
        }

        // Aumentar el contador de intentos fallidos
        session(['login_attempts' => $attempts + 1]);

        // Registro del error por seguridad con IP (Punto 10)
        Log::warning('Intento de inicio de sesión fallido', [
            'login_intentado' => $request->login,
            'ip' => $request->ip(),
            'intentos' => $attempts + 1,
            'timestamp' => now()
        ]);

        // Si falla, regresar con un error
        return back()->withErrors([
            'login' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('login');
    }

    // Cierra la sesión del usuario
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }

    // Genera un Captcha Matemático complejo
    private function generateCaptcha()
    {
        $operators = ['+', '-', '*'];
        $op = $operators[array_rand($operators)];
        $num1 = rand(1, 15);
        $num2 = rand(1, 10);
        
        if ($op === '-') {
            // Evitar resultados negativos
            if ($num1 < $num2) {
                $temp = $num1;
                $num1 = $num2;
                $num2 = $temp;
            }
            $answer = $num1 - $num2;
        } elseif ($op === '*') {
            $num1 = rand(2, 9);
            $num2 = rand(2, 9);
            $answer = $num1 * $num2;
        } else {
            $answer = $num1 + $num2;
        }

        // Diccionario para convertir números a texto
        $numeros_texto = [
            1 => 'uno', 2 => 'dos', 3 => 'tres', 4 => 'cuatro', 5 => 'cinco',
            6 => 'seis', 7 => 'siete', 8 => 'ocho', 9 => 'nueve', 10 => 'diez',
            11 => 'once', 12 => 'doce', 13 => 'trece', 14 => 'catorce', 15 => 'quince'
        ];

        // Aleatoriamente decide si mostrar el número en letras o en dígitos (Confunde a los bots básicos)
        $displayNum1 = rand(0, 1) ? ($numeros_texto[$num1] ?? $num1) : $num1;
        $displayNum2 = rand(0, 1) ? ($numeros_texto[$num2] ?? $num2) : $num2;

        return [
            'question' => "$displayNum1 $op $displayNum2 = ?",
            'answer' => $answer
        ];
    }
}