<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AgendaActividad;

class AgendaDesplazamiento extends Model
{
    use HasFactory;

    protected $table = 'agendas_desplazamiento';

    protected $fillable = [
        'user_id',
        'nombre_completo',
        'tipo_documento',
        'numero_documento',
        'cargo',

        'numero_contrato',
        'anio_contrato',
        'fecha_elaboracion',
        'fecha_vencimiento',
        'objetivo_contractual',

        'municipio_destino',
        'ruta',
        'ciudad_destino',
        'entidad_empresa',
        'contacto',
        'fecha_inicio_desplazamiento',
        'fecha_fin_desplazamiento',
        'objetivo_desplazamiento',

        'direccion_general',
        'dependencia_centro',

        'obligaciones_contrato',

        // Firmas
        'firma_contratista',
        'firma_supervisor',
        'firma_ordenador',

        // Control de Estado
        'estado',

        // CAMPOS NUEVOS PARA VIÁTICOS
        'valor_viaticos',       // Monto calculado por el liquidador
        'observaciones_finanzas' // Notas del área de viáticos
    ];

    protected $casts = [
        'obligaciones_contrato' => 'array',
        'fecha_inicio_desplazamiento' => 'date',
        'fecha_fin_desplazamiento' => 'date',
        'valor_viaticos' => 'decimal:2',
    ];

    /**
     * Relación con el usuario que creó la agenda
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con las actividades detalladas
     */
    public function actividades()
    {
        return $this->hasMany(AgendaActividad::class, 'agenda_desplazamiento_id');
    }
}