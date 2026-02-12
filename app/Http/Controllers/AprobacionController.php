<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;
use Illuminate\Support\Facades\Storage;

class AprobacionController extends Controller
{
    public function index()
    {
        $agendas = AgendaDesplazamiento::whereIn('estado', ['ENVIADA', 'APROBADA_COORDINADOR', 'LIQUIDADA'])
            ->with('user')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('coordinador.index', compact('agendas'));
    }

    public function autorizar(Request $request, $id)
    {
        $request->validate([
            'firma_archivo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $agenda = AgendaDesplazamiento::findOrFail($id);

        if ($request->hasFile('firma_archivo')) {
            // Limpieza de firma anterior
            if ($agenda->firma_supervisor) {
                Storage::disk('public')->delete($agenda->firma_supervisor);
            }

            $rutaFirma = $request->file('firma_archivo')->store('firmas_coordinadores', 'public');
            
            $agenda->update([
                'estado' => 'APROBADA_COORDINADOR',
                'firma_supervisor' => $rutaFirma,
                'fecha_firma_coordinador' => now(),
                'observaciones_finanzas' => null // Saneamos la agenda
            ]);
        }

        return redirect()->route('coordinador.index')
            ->with('alerta_exitosa', 'Agenda autorizada y enviada a Viáticos.');
    }
}