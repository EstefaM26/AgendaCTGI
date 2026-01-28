<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;

class AgendaController extends Controller
{
    public function store(Request $request)
    {
        $datos = $request->all();

        if ($request->hasFile('firma_contratista')) {
            $datos['firma_contratista'] = $request->file('firma_contratista')
                ->store('firmas', 'public');
        }

        $agenda = AgendaDesplazamiento::create([
            'user_id' => auth()->id(),
            'nombre_completo' => $datos['nombre_completo'],
            'tipo_documento' => $datos['tipo_documento'],
            'numero_documento' => $datos['numero_documento'],
            'cargo' => $datos['cargo'],
            'numero_contrato' => $datos['numero_contrato'],
            'anio_contrato' => $datos['anio_contrato'],
            'fecha_elaboracion' => $datos['fecha_elaboracion'],
            'fecha_vencimiento' => $datos['fecha_vencimiento'],
            'objetivo_contractual' => $datos['objetivo_contractual'],
            'municipio_destino' => $datos['municipio_destino'],
            'entidad_empresa' => $datos['entidad_empresa'],
            'contacto' => $datos['contacto'],
            'fecha_inicio_desplazamiento' => $datos['fecha_inicio_desplazamiento'],
            'fecha_fin_desplazamiento' => $datos['fecha_fin_desplazamiento'],
            'objetivo_desplazamiento' => $datos['objetivo_desplazamiento'],
            'obligaciones_contrato' => $datos['obligaciones_contrato'],
            'firma_contratista' => $datos['firma_contratista'] ?? null,
            'estado' => 'ENVIADA',
        ]);

        // CAMBIO AQUÍ: Ahora pasamos el agenda_id a la sesión
        return redirect()
            ->route('formulario')
            ->with([
                'success' => 'Agenda creada correctamente',
                'agenda_id' => $agenda->id // Este es el dato que le faltaba a tu vista
            ]);
    }

    // Método corregido apuntando a resources/views/pdf.blade.php
    public function verPdf($id)
    {
        $agenda = AgendaDesplazamiento::with('actividades')->findOrFail($id);
        return view('pdf', compact('agenda'));
    }
}