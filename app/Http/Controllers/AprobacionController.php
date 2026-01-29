<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AprobacionController extends Controller
{
    /**
     * Listado de agendas que esperan firma del Coordinador (Estado: ENVIADA)
     */
    public function index()
    {
        $agendas = AgendaDesplazamiento::where('estado', 'ENVIADA')->get();
        return view('coordinador.index', compact('agendas'));
    }

    /**
     * Acción de "Firmar" (Autorizar) recibiendo archivo de imagen
     */
    public function autorizar(Request $request, $id)
    {
        // 1. Validar que el archivo sea una imagen válida
        $request->validate([
            'firma_archivo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $agenda = AgendaDesplazamiento::findOrFail($id);

        // 2. Procesar y guardar la imagen de la firma
        if ($request->hasFile('firma_archivo')) {
            // Se guarda en storage/app/public/firmas_coordinadores
            $rutaFirma = $request->file('firma_archivo')->store('firmas_coordinadores', 'public');
            
            // 3. Actualizar la agenda con la ruta del archivo y cambio de estado
            $agenda->update([
                'estado' => 'APROBADA_COORDINADOR',
                'firma_supervisor' => $rutaFirma, // Guardamos la ruta del archivo, no el nombre del usuario
                'fecha_firma_coordinador' => now(), // Es buena práctica registrar cuándo se firmó
            ]);
        }

        // 4. Redirigir con mensaje de éxito (la alerta que querías)
        return redirect()->route('coordinador.index')
            ->with('alerta_exitosa', '¡Proceso exitoso! La agenda ha sido firmada y enviada a Subdirección para su revisión final.');
    }
}