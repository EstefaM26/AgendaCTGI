<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SubdirectorController extends Controller
{
    /**
     * Muestra la bandeja de entrada del Subdirector.
     * Solo agendas con visto bueno del Coordinador.
     */
    public function index()
    {
        // Traemos las agendas con estado 'APROBADA_COORDINADOR'
        // Ordenadas por la más reciente para facilitar el trabajo
        $agendas = AgendaDesplazamiento::where('estado', 'APROBADA_COORDINADOR')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('subdirector.index', compact('agendas'));
    }

    /**
     * Proceso de firma del Subdirector (Ordenador de Gasto)
     */
    public function autorizar(Request $request, $id)
    {
        // 1. Validación de seguridad y de archivo
        if (Auth::user()->role !== 'subdirector') {
            return redirect()->back()->with('error', 'No tiene permisos para realizar esta acción.');
        }

        $request->validate([
            'firma_ordenador' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // 2. Localizar la agenda
        $agenda = AgendaDesplazamiento::findOrFail($id);

        // 3. Procesar la firma y actualizar estado
        if ($request->hasFile('firma_ordenador')) {
            
            // Si ya existía una firma anterior (por re-intento), la eliminamos para no llenar el servidor
            if ($agenda->firma_ordenador) {
                Storage::disk('public')->delete($agenda->firma_ordenador);
            }

            // Guardar la nueva firma en la carpeta firmas_subdirector
            $rutaFirma = $request->file('firma_ordenador')->store('firmas_subdirector', 'public');
            
            $agenda->update([
                'estado' => 'APROBADA_SUBDIRECTOR', // Estado final del flujo
                'firma_ordenador' => $rutaFirma,
            ]);

            return redirect()->route('subdirector.index')->with('success', 'Agenda autorizada y firmada correctamente. El proceso ha finalizado.');
        }

        return redirect()->back()->with('error', 'Hubo un problema al cargar la imagen de la firma.');
    }
}