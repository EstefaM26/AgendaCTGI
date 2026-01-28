<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\AgendaActividadController;
use App\Http\Controllers\FormularioController;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Ruta para ver el formulario vacío
// --- Rutas del Formulario y Agenda ---

// Ver formulario
Route::get('/formulario', function () {
    $municipios = ['Barbosa', 'Girardota', 'Copacabana', 'Bello', 'Itagüí', 'Envigado', 'Sabaneta', 'Caldas', 'La Estrella'];
    return view('formulario', compact('municipios'));
})->name('formulario');

// GUARDAR FORMULARIO (Solo una vez)
Route::post('/formulario', [AgendaController::class, 'store'])->name('formulario.store');

// VER PDF (Asegúrate de que el nombre sea agenda.pdf)
Route::get('/ver-pdf/{id}', [AgendaController::class, 'verPdf'])->name('agenda.pdf');



// --- Rutas de Reportes ---

// --- Rutas de Reportes utilizando ReportesController ---

// Esta es la ruta para la lista general (la que usa el sidebar)
// --- Rutas para Reportes ---

// 1. Esta es la que usa el menú lateral (reportes)
Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');

// 2. Esta es la que usa el botón de "Reportar actividades" (detalle)
Route::get('/reportes-detalle/{agenda}', [ReportesController::class, 'show'])->name('reportes.show');

// 3. Esta es para guardar los datos del formulario verde
Route::post('/reportes-detalle/{agenda}/guardar', [ReportesController::class, 'store'])->name('actividades.store');

Route::get('/reportes', [ReportesController::class, 'index'])
    ->name('reportes');

Route::get('/reportes-detalle/{agenda}', [ReportesController::class, 'show'])
->name('reportes.show');


