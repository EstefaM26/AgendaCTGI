<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\AgendaActividadController;
use App\Http\Controllers\ReportarDiaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//  Página inicial (login de Breeze)
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

//  Rutas de autenticación (Breeze)
require __DIR__ . '/auth.php';

// Vista previa PDF 
Route::get('/pdf-preview', function () {
    return view('agenda.pdf');
});

// Guardar actividad (requiere login)
Route::post('/agenda/{id}/actividad', [AgendaActividadController::class, 'store'])
    ->middleware('auth')
    ->name('agenda.actividad.store');


// Rutas protegidas
Route::middleware('auth')->group(function () {

    // // Dashboard Instructor Administrativo
    Route::get('/instructor', function () {
        return view('instructor.dashboard');
    })
    ->middleware('rol:instructor')
    ->name('dashboard.instructor');

    //Dashboard Lider de Proceso AgendA
    Route::get('/lider', function () {
        return view('lider.dashboard');
    })
    ->middleware('rol:lider')
    ->name('dashboard.lider');

    //Dashboard Supervisor Contrato
    Route::get('/supervisor', function () {
        return view('supervisor.dashboard');
    })
    ->middleware('rol:supervisor')
    ->name('dashboard.supervisor');


    // Formulario (usuarios normales)
    Route::get('/formulario/{id?}', [FormularioController::class, 'index'])
        ->middleware('rol:user')
        ->name('formulario');

    Route::post('/formulario', [FormularioController::class, 'store'])
        ->middleware('rol:user')
        ->name('formulario.store');

    // PDF Agenda
    Route::get('/agenda/{id}/pdf', [FormularioController::class, 'pdf'])
        ->middleware('rol:user')
        ->name('agenda.pdf');

    // Reportar día
    Route::get('/reportar-dia', [ReportarDiaController::class, 'index'])
        ->middleware('rol:user')
        ->name('reportar-dia');

    Route::get('/reportar-dia/{agenda}', [ReportarDiaController::class, 'show'])
        ->middleware('rol:user')
        ->name('reportar-dia.show');
});


// Redireccion por rol

Route::get('/redirect', function () {
    $user = auth()->user();

    return match ($user->rol) {
        'instructor' => redirect()->route('dashboard.instructor'),
        'lider' => redirect()->route('dashboard.lider'),
        'supervisor' => redirect()->route('dashboard.supervisor'),
        'user'  => redirect()->route('formulario'),
        default => abort(403),
    };
})
->middleware('auth')
->name('redirect');
