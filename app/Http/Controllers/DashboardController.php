<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaDesplazamiento;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rol = $user->role;

        // Contamos las agendas según el estado para los badges
        $pendientesCoord = AgendaDesplazamiento::where('estado', 'ENVIADA')->count();
        $pendientesSub = AgendaDesplazamiento::where('estado', 'APROBADA_COORDINADOR')->count();

        return view('inicio', compact('rol', 'pendientesCoord', 'pendientesSub'));
    }
}