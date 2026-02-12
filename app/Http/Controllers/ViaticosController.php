<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;

class ViaticosController extends Controller
{
    public function index()
    {
        // Traemos las agendas que están en revisión técnica (APROBADA_COORDINADOR)
        // Y también las enviadas o liquidadas para el historial
        $agendas = AgendaDesplazamiento::with('user')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('viaticos.index', compact('agendas'));
    }

    public function procesar(Request $request, $id)
    {
        $agenda = AgendaDesplazamiento::findOrFail($id);
        
        $request->validate([
            'observaciones' => 'required|string|max:1000',
            'accion' => 'required'
        ]);

        if ($request->accion == 'aprobar') {
            $agenda->update([
                'estado' => 'LIQUIDADA', 
                'observaciones_finanzas' => $request->observaciones
            ]);
            return redirect()->back()->with('success', 'Agenda liquidada correctamente.');
        } 
        
        if ($request->accion == 'devolver') {
            // Al devolver, quitamos la firma del coordinador para que deba revisar de nuevo
            $agenda->update([
                'estado' => 'ENVIADA', 
                'firma_supervisor' => null,
                'observaciones_finanzas' => $request->observaciones
            ]);
            return redirect()->back()->with('warning', 'Agenda devuelta al Coordinador.');
        }
    }
}