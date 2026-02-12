<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $filtro = $request->get('ver');

        // 1. Base de la consulta
        $query = AgendaDesplazamiento::query();

        // 2. Definir qué es "Pendiente" para cada rol
        // Esto evita que un admin vea lo de viáticos y viceversa
        $estadoPendiente = match($user->role) {
            'administrador', 'contratista' => 'ENVIADA',           // Para él, pendiente es lo que acaba de enviar o está corrigiendo
            'coordinador'                  => 'ENVIADA',           // Para él, lo que debe firmar
            'viaticos'                     => 'APROBADA_COORDINADOR', // Para él, lo que ya firmó el jefe
            'subdirector'                  => 'LIQUIDADA',         // Para él, lo que ya pasó por viáticos
            default                        => 'ENVIADA',
        };

        // 3. Aplicar privacidad de registros
        // Contratistas/Admins solo ven lo SUYO. Otros ven lo que les toca gestionar globalmente.
        if ($user->role === 'administrador' || $user->role === 'contratista') {
            $query->where('user_id', $user->id);
        }

        // 4. ESTADÍSTICAS FILTRADAS POR ROL
        $stats = [
            // Solo cuenta lo pendiente según su flujo de trabajo
            'pendientes' => (clone $query)->where('estado', $estadoPendiente)->count(),
            
            // Enviadas o finalizadas (Ya salieron de su bandeja)
            'enviadas'   => (clone $query)->where('estado', 'LIQUIDADA')->count(),
            
            // Devueltas (Solo si tienen observaciones de finanzas)
            'devueltas'  => (clone $query)->whereNotNull('observaciones_finanzas')
                                          ->where('estado', '!=', 'LIQUIDADA')
                                          ->count(),
        ];

        // 5. Listado para la tabla respetando el filtro del rol
        $agendas = $query->when($filtro == 'pendientes', function($q) use ($estadoPendiente) {
                return $q->where('estado', $estadoPendiente);
            })
            ->when($filtro == 'enviadas', function($q) {
                return $q->where('estado', 'LIQUIDADA');
            })
            ->when($filtro == 'devueltas', function($q) {
                return $q->whereNotNull('observaciones_finanzas')->where('estado', '!=', 'LIQUIDADA');
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('inicio', compact('stats', 'agendas', 'filtro'));
    }
}