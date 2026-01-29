<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  <-- Este es el parámetro que enviaremos desde la ruta
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Verificar si el rol del usuario coincide con el requerido
        if (Auth::user()->role !== $role) {
            // Si no tiene el rol, lo mandamos al dashboard con un error
            return redirect('/dashboard')->with('error', 'No tienes permisos para acceder a esta área.');
        }

        return $next($request);
    }
}