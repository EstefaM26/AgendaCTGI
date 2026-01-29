<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\SubdirectorController;

// --- RUTAS PÚBLICAS (Invitados) ---
Route::middleware('guest')->group(function () {
    // Redirigir la raíz al login o bienvenida
    Route::get('/', function () { return view('auth.login'); });
    
    // Rutas de Login
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// --- RUTAS PROTEGIDAS (Solo usuarios logueados) ---
Route::middleware('auth')->group(function () {

    // 1. INICIO DINÁMICO (El que maneja los 3 roles)
    Route::get('/inicio', [DashboardController::class, 'index'])->name('inicio');

    // 2. CERRAR SESIÓN
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // 3. FORMULARIO (Contratista)
    Route::get('/formulario', [FormularioController::class, 'index'])->name('formulario');
    Route::post('/formulario', [AgendaController::class, 'store'])->name('formulario.store');

    // 4. PDF
    Route::get('/ver-pdf/{id}', [AgendaController::class, 'verPdf'])->name('agenda.pdf');

    // 5. REPORTES
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');
    Route::get('/reportes-detalle/{agenda}', [ReportesController::class, 'show'])->name('reportes.show');
    Route::post('/reportes-detalle/{agenda}/guardar', [ReportesController::class, 'store'])->name('actividades.store');

    // 6. RUTAS DE APROBACIÓN (Próximamente para Coordinador y Subdirector)
    // Rutas para el Coordinador
    Route::get('/por-autorizar', [App\Http\Controllers\AprobacionController::class, 'index'])->name('coordinador.index');
    Route::post('/autorizar-agenda/{id}', [App\Http\Controllers\AprobacionController::class, 'autorizar'])->name('agenda.autorizar');
    // Route::get('/revisar/{id}', [AprobacionController::class, 'revisar'])->name('agenda.revisar');
    Route::post('/autorizar-agenda/{id}', [App\Http\Controllers\AprobacionController::class, 'autorizar'])->name('agenda.autorizar');

    // Rutas para el Subdirector
    // Panel del Subdirector
    Route::get('/subdirector/bandeja', [SubdirectorController::class, 'index'])->name('subdirector.index');
    // Acción de firmar
    Route::post('/subdirector/firmar/{id}', [SubdirectorController::class, 'autorizar'])->name('subdirector.autorizar');
});