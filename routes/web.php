<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminOrdenController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\AdminReporteController;
use App\Http\Controllers\AdminGerenciaController;

// ==========================================
// 1. RUTAS PÚBLICAS
// ==========================================
Route::get('/', [PortafolioController::class, 'index'])->name('home');
Route::get('/comercio', [ComercioController::class, 'index'])->name('comercio.index');

// ==========================================
// 2. RUTAS DE AUTENTICACIÓN
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 3. RUTAS DEL CLIENTE (Solo usuarios logueados)
// ==========================================
Route::middleware(['auth'])->group(function () {
    Route::get('/mi-carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/mi-carrito/agregar/{producto}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('/mi-carrito/quitar/{carrito}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::post('/mi-carrito/checkout', [CarritoController::class, 'checkout'])
        ->middleware('throttle:3,1') // Límite: 3 compras por minuto por usuario
        ->name('carrito.checkout');
    Route::get('/mis-compras', [CarritoController::class, 'misCompras'])->name('carrito.mis_compras');
});

// ==========================================
// 4. RUTAS DEL PANEL DE ADMINISTRACIÓN (Técnico y Admin)
// ==========================================
Route::middleware(['auth', 'role:administrador,tecnico'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard General
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD de Maletín Digital
    Route::get('/portafolio/editar', [PortafolioController::class, 'edit'])->name('portafolio.edit');
    Route::put('/portafolio/actualizar', [PortafolioController::class, 'update'])->name('portafolio.update');

    // CRUD de Productos y Usuarios
    Route::resource('productos', AdminProductoController::class)->except(['show']);
    Route::resource('usuarios', AdminUsuarioController::class)->except(['show']);

    // Gestión de Órdenes
    Route::get('/ordenes', [AdminOrdenController::class, 'index'])->name('ordenes.index');
    Route::put('/ordenes/{orden}/estado', [AdminOrdenController::class, 'updateStatus'])->name('ordenes.update_status');
});

// ==========================================
// 5. RUTAS EXCLUSIVAS DEL ADMINISTRADOR
// ==========================================
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->name('admin.')->group(function () {
    
    // Módulo de Reportes
    Route::get('/reportes', [AdminReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/pdf', [AdminReporteController::class, 'pdfGeneral'])->name('reportes.pdf');
    Route::get('/reportes/excel', [AdminReporteController::class, 'excelProductos'])->name('reportes.excel');
    Route::get('/gerencia', [AdminGerenciaController::class, 'index'])->name('gerencia.index');
});