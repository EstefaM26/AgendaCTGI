<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\SubdirectorController;
use App\Http\Controllers\ViaticosController; 
use App\Http\Controllers\AprobacionController;

// --- RUTAS PÚBLICAS (Invitados) ---
Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('auth.login'); });
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// --- RUTAS PROTEGIDAS (Solo usuarios logueados) ---
Route::middleware('auth')->group(function () {

    // 1. INICIO DINÁMICO
    Route::get('/inicio', [DashboardController::class, 'index'])->name('inicio');

    // 2. CERRAR SESIÓN
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // 3. FORMULARIO (Contratista)
    Route::get('/formulario', [FormularioController::class, 'index'])->name('formulario');
    Route::post('/formulario', [AgendaController::class, 'store'])->name('formulario.store');

    // 4. PDF
    Route::get('/ver-pdf/{id}', [AgendaController::class, 'verPdf'])->name('agenda.pdf');

    // 5. REPORTES (Historial General)
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');
    Route::get('/reportes-detalle/{agenda}', [ReportesController::class, 'show'])->name('reportes.show');
    Route::post('/reportes-detalle/{agenda}/guardar', [ReportesController::class, 'store'])->name('actividades.store');

    // 6. RUTAS DE COORDINADOR
    Route::get('/por-autorizar', [AprobacionController::class, 'index'])->name('coordinador.index');
    Route::post('/autorizar-agenda/{id}', [AprobacionController::class, 'autorizar'])->name('agenda.autorizar');

    // 7. RUTAS DE SUBDIRECTOR
    Route::get('/subdirector/bandeja', [SubdirectorController::class, 'index'])->name('subdirector.index');
    Route::post('/subdirector/firmar/{id}', [SubdirectorController::class, 'autorizar'])->name('subdirector.autorizar');

    // 8. RUTAS EXCLUSIVAS DE VIÁTICOS (Ubicadas aquí o en su middleware propio)
    Route::middleware(['role:viaticos'])->group(function () {
        // Bandeja de entrada de viáticos
        Route::get('/viaticos/bandeja', [ViaticosController::class, 'index'])->name('viaticos.index');
        
        // Vista de gestión (La pantalla dividida)
        Route::get('/viaticos/gestionar/{id}', [ViaticosController::class, 'gestionar'])->name('viaticos.gestionar');
        
        // Proceso de aprobación o devolución
        Route::post('/viaticos/procesar/{id}', [ViaticosController::class, 'procesar'])->name('viaticos.procesar');
    });

});