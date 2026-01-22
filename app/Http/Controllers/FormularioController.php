<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;

class FormularioController extends Controller
{
    public function index($id = null)
    {
        $agenda = null;
        if ($id) {
            $agenda = AgendaDesplazamiento::with('actividades')->findOrFail($id);
        }

        $municipios = [
            'BARBOSA',
            'BELLO',
            'CALDAS',
            'COPACABANA',
            'ENVIGADO',
            'GIRARDOTA',
            'ITAGUI',
            'LA ESTRELLA',
            'SABANETA'
        ];

        return view('formulario', compact('municipios', 'agenda'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'tipo_documento' => 'required|string',
            'numero_documento' => 'required|string|max:50',
            'fecha_elaboracion' => 'required|date',

            'numero_contrato' => 'required|numeric',
            'anio_contrato' => 'required|integer',
            'fecha_vencimiento' => 'required|date|after_or_equal:today',

            'cargo' => 'required|in:Instructor,Servidor_Publico',
            'objetivo_contractual' => 'required|string',

            'municipio_destino' => 'required|string|max:100',

            'entidad_empresa' => 'required|string|max:120',
            'contacto' => 'required|string|max:120',

            'fecha_inicio_desplazamiento' => 'required|date|after_or_equal:today',
            'fecha_fin_desplazamiento' => 'required|date|after_or_equal:fecha_inicio_desplazamiento',

            'objetivo_desplazamiento' => 'required|string|max:160',

            'obligaciones_contrato' => 'required|array|min:1',
            'obligaciones_contrato.*' => 'required|string|max:500',

            'firma_contratista' => 'nullable|image|max:4096',
        ]);




        /* ================= DATOS CALCULADOS ================= */

        $data['ruta'] = 'MEDELLÍN - ' . $data['municipio_destino'] . ' - MEDELLÍN';
        $data['ciudad_destino'] = $data['municipio_destino'];

        $data['direccion_general'] = 'ANTIOQUIA';
        $data['dependencia_centro'] = 'CENTRO TEXTIL Y DE GESTION INDUSTRIAL';

        $data['obligaciones_contrato'] = $request->obligaciones_contrato;

        $data['estado'] = 'ENVIADA';
        $data['user_id'] = auth()->id();

        if ($request->hasFile('firma_contratista')) {
            $data['firma_contratista'] = $request
                ->file('firma_contratista')
                ->store('firmas', 'public');
        }

        $agenda = AgendaDesplazamiento::create($data);

        return redirect()->route('formulario', $agenda->id)
            ->with('success', 'Agenda creada. Ahora puede agregar actividades.');
    }

    public function pdf($id)
    {
        $agenda = AgendaDesplazamiento::with('actividades')->findOrFail($id);
        return view('agenda.pdf', compact('agenda'));
    }
}
