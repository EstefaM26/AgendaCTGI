<?php

namespace App\Http\Controllers;

use App\Models\AgendaDesplazamiento;
use Illuminate\Http\Request;

class ReportarDiaController extends Controller
{
    /**
     * Muestra la lista de agendas del usuario para reportar días.
     */
    public function index()
    {
        $agendas = AgendaDesplazamiento::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('reportar_dia.index', compact('agendas'));
    }

    /**
     * Muestra el formulario para reportar un día específico en una agenda.
     */
    public function show(AgendaDesplazamiento $agenda)
    {
        // Validar que la agenda pertenezca al usuario (opcional pero recomendado)
        if ($agenda->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a esta agenda.');
        }

        $agenda->load('actividades');

        return view('reportar_dia.show', compact('agenda'));
    }
}
