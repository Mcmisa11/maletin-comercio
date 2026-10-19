<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUsuarioController extends Controller
{
    // 1. Listar usuarios
    public function index()
    {
        $usuarios = User::with('role')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    // 2. Formulario para crear un usuario
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    // 3. Guardar el nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => trim(strip_tags($request->name)),
            'username' => $request->username ? trim(strip_tags($request->username)) : null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // 4. Formulario de edición
    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    // 5. Actualizar usuario
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8', // La contraseña es opcional al editar
        ]);

        $usuario->name = trim(strip_tags($request->name));
        $usuario->username = $request->username ? trim(strip_tags($request->username)) : null;
        $usuario->email = $request->email;
        $usuario->role_id = $request->role_id;

        // Solo cambiamos la contraseña si el campo no está vacío
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // 6. Eliminar usuario
    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return redirect()->route('admin.usuarios.index')->withErrors(['error' => 'No puedes eliminar tu propia cuenta.']);
        }

        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado del sistema.');
    }
}