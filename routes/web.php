<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\AgendaActividadController;
use App\Http\Controllers\ReportarDiaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';


Route::get('/pdf-preview', function () {
    return view('agenda.pdf');
});

Route::post('/agenda/{id}/actividad', [AgendaActividadController::class, 'store'])
    ->name('agenda.actividad.store');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //vista formulario
    Route::get('/formulario/{id?}', [FormularioController::class, 'index'])
        ->name('formulario');

    //envio formulario
    Route::post('/formulario', [FormularioController::class, 'store'])
        ->name('formulario.store');

    //vista / descarga del pdf
    Route::get('/agenda/{id}/pdf', [FormularioController::class, 'pdf'])
        ->name('agenda.pdf');

    Route::get('/reportar-dia', [ReportarDiaController::class, 'index'])
        ->name('reportar-dia');

    Route::get('/reportar-dia/{agenda}', [ReportarDiaController::class, 'show'])
        ->name('reportar-dia.show');
});