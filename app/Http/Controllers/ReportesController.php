<?php

namespace App\Http\Controllers;

use App\Models\AgendaActividad;
use App\Models\AgendaDesplazamiento;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function show(AgendaDesplazamiento $agenda)
    {
        $agenda->load('actividades');
        return view('reportes_detalle', compact('agenda'));
    }

    public function index()
    {
        $agendas = AgendaDesplazamiento::orderBy('updated_at', 'desc')->get();

        return view('reportes', compact('agendas'));
    }


    // 👇 ESTE ES EL MÉTODO QUE FALTABA
    public function store(Request $request, AgendaDesplazamiento $agenda)
    {
        $request->validate([
            'fecha_reporte' => 'required|date',
            'ruta_ida' => 'required|string',
            'ruta_regreso' => 'required|string',
            'actividades_ejecutar' => 'required|string',
            'medios_transporte' => 'nullable|array',
            'desplazamientos_internos' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $agenda->actividades()->create([
            'fecha_reporte' => $request->fecha_reporte,
            'ruta_ida' => $request->ruta_ida,
            'ruta_regreso' => $request->ruta_regreso,
            'medios_transporte' => $request->medios_transporte,
            'actividades_ejecutar' => $request->actividades_ejecutar,
            'desplazamientos_internos' => $request->desplazamientos_internos,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()
            ->route('reportes.show', $agenda->id)
            ->with('success', 'Actividad registrada correctamente');
    }
}
