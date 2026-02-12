<?php

namespace App\Http\Controllers;

use App\Models\AgendaActividad;
use App\Models\AgendaDesplazamiento;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    /**
     * Punto de entrada único para "Reportes"
     */
    public function index()
    {
        $user = auth()->user();

        // CASO 1: Si el usuario es de VIÁTICOS
        if ($user->role == 'viaticos') {
            $agendas = AgendaDesplazamiento::whereIn('estado', ['APROBADA_COORDINADOR', 'LIQUIDADA'])
                ->with('user')
                ->orderBy('updated_at', 'desc')
                ->get();
            
            // Retorna la vista de la consola de gestión
            return view('viaticos.index', compact('agendas'));
        }

        // CASO 2: Para los demás (Contratistas, etc.)
        // Filtramos para que el contratista solo vea las suyas
        $query = AgendaDesplazamiento::with('user');
        
        if ($user->role == 'contratista') {
            $query->where('user_id', $user->id);
        }

        $agendas = $query->orderBy('created_at', 'desc')->get();

        return view('reportes', compact('agendas'));
    }

    /**
     * Muestra el detalle (Para contratistas es el reporte de actividades, 
     * para administrativos es la pantalla de gestión)
     */
    public function show(AgendaDesplazamiento $agenda)
    {
        $agenda->load('actividades');
        $user = auth()->user();

        // Si es viáticos, lo mandamos a la pantalla de gestión (la dividida)
        if ($user->role == 'viaticos') {
            return view('viaticos.gestionar', compact('agenda'));
        }

        // Si es otro rol, a la vista de detalle normal
        return view('reportes_detalle', compact('agenda'));
    }

    /**
     * Guarda actividades (Usado por el contratista)
     */
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