<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Portafolio;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Roles obligatorios
        $rolAdmin = Role::create(['nombre' => 'administrador']);
        $rolTecnico = Role::create(['nombre' => 'tecnico']);
        $rolInvitado = Role::create(['nombre' => 'invitado']);

        // 2. Crear Usuarios de Prueba requeridos
        User::create([
            'name' => 'Admin Test',
            'username' => 'admin1',
            'email' => 'admin1@test.com',
            'password' => Hash::make('123'),
            'role_id' => $rolAdmin->id
        ]);

        User::create([
            'name' => 'Tecnico Test',
            'username' => 'tecnico1',
            'email' => 'tecnico1@test.com',
            'password' => Hash::make('123'),
            'role_id' => $rolTecnico->id
        ]);

        User::create([
            'name' => 'Cliente Test',
            'username' => 'cliente1',
            'email' => 'cliente1@test.com',
            'password' => Hash::make('123'),
            'role_id' => $rolInvitado->id
        ]);

        // 3. Crear Cuenta Maestra de Administrador
        User::create([
            'name' => 'Misael Adalid Carvajal',
            'username' => 'misael_admin',
            'email' => 'misael@carvajal.com',
            'password' => Hash::make('1234567890'),
            'role_id' => $rolAdmin->id
        ]);

        // 4. Inicializar Datos del Maletín Digital
        Portafolio::create([
            'nombre_completo' => 'Misael Adalid Carvajal',
            'profesion' => 'Profesor de Informática y Desarrollador de Software',
            'biografia' => 'Estudiante de Informática de Sistemas en el Instituto Tecnológico Bolivia Mar, actualmente trabajando en el desarrollo de un sistema de verificación de inventarios web y móvil. Experiencia impartiendo clases de computación a nivel primario y en el desarrollo de aplicaciones con arquitectura MVC.',
            'ubicacion' => 'Bolivia',
            'habilidades' => json_encode(['Kotlin', 'Android Studio', 'Laravel', 'PHP', 'MySQL', 'HTML/CSS']),
            'github_url' => 'https://github.com/misaelcarvajal',
            'linkedin_url' => 'https://linkedin.com/in/misaelcarvajal',
        ]);
    }
}