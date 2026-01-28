<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaActividad extends Model
{
    use HasFactory;

    protected $table = 'agenda_actividades';

    protected $fillable = [
        'agenda_desplazamiento_id',
        'fecha_reporte',
        'ruta_ida',
        'ruta_regreso',
        'medios_transporte',
        'actividades_ejecutar',
        'desplazamientos_internos',
        'observaciones',
    ];

    protected $casts = [
        'medios_transporte' => 'array',
        'fecha_reporte' => 'date',
    ];

    /* ================= RELACIONES ================= */
    
    public function agenda()
    {
        return $this->belongsTo(AgendaDesplazamiento::class);
    }
}
