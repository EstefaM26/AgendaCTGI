<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaActividad;
use App\Models\AgendaDesplazamiento;
use Carbon\Carbon;

class AgendaActividadController extends Controller
{
    public function store(Request $request, $agendaId)
    {
        $agenda = AgendaDesplazamiento::findOrFail($agendaId);

        $data = $request->validate([
            'fecha_reporte' => [
                'required',
                'date',
                'after_or_equal:' . $agenda->fecha_inicio_desplazamiento,
                'before_or_equal:' . $agenda->fecha_fin_desplazamiento,
            ],
            'medios_transporte' => 'required|array|min:1',
            'medios_transporte.*' => 'in:area,terrestre,fluvial',

            'actividades_ejecutar' => 'required|string|max:500',
            'desplazamientos_internos' => 'nullable|string|max:150',
            'observaciones' => 'nullable|string|max:255',
        ]);

        AgendaActividad::create([
            'agenda_desplazamiento_id' => $agenda->id,
            'fecha_reporte' => $data['fecha_reporte'],
            'ruta_ida' => 'MEDELLÍN - ' . $agenda->municipio_destino,
            'ruta_regreso' => $agenda->municipio_destino . ' - MEDELLÍN',
            'medios_transporte' => $data['medios_transporte'],
            'actividades_ejecutar' => $data['actividades_ejecutar'],
            'desplazamientos_internos' => $data['desplazamientos_internos'] ?? null,
            'observaciones' => $data['observaciones'] ?? null,
        ]);

        return back()->with('success', 'Actividad registrada correctamente');
    }
}
