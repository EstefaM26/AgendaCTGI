@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Reportar Día</h2>
        <a href="{{ route('reportes') }}" class="btn btn-outline-secondary rounded-pill">Volver a la lista</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header text-white fw-bold py-3" style="background-color: #4b8a5f;">
            Detalles de Actividades para la Agenda #{{ $agenda->id }}
        </div>
        <div class="card-body p-4">
            {{-- El action debe ir al controlador que guarda las actividades --}}
            <form action="{{ route('actividades.store', $agenda->id) }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Día a reportar</label>
                        <input type="date" name="fecha_reporte" class="form-control" required>
                        
                        <label class="form-label fw-bold mt-3">Ruta de Ida (Desplazamientos)</label>
                        <input type="text" name="ruta_ida" class="form-control bg-light" value="MEDELLÍN - {{ $agenda->municipio_destino }} - MEDELLÍN" readonly>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Medio de transporte</label>
                        <div class="d-flex gap-3 mt-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="medios_transporte[]" value="Aéreo">
                                <label class="form-check-label">Aéreo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="medios_transporte[]" value="Terrestre">
                                <label class="form-check-label">Terrestre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="medios_transporte[]" value="Fluvial">
                                <label class="form-check-label">Fluvial</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Actividades a ejecutar</label>
                        <textarea name="actividades_ejecutar" class="form-control" rows="4" placeholder="Describa las actividades realizadas..." required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Desplazamientos Internos</label>
                        <input type="text" name="desplazamientos_internos" class="form-control mb-3" placeholder="Lugar o N/A">
                        
                        <label class="form-label fw-bold">Ruta de Regreso (Destino Final)</label>
                        <input type="text" name="ruta_regreso" class="form-control bg-light" value="{{ $agenda->municipio_destino }} - MEDELLÍN" readonly>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3" placeholder="Ej: Se liquidan gastos de transporte..."></textarea>
                </div>

                <button type="submit" class="btn text-white w-100 fw-bold py-2" style="background-color: #4b8a5f;">
                    Guardar Actividad
                </button>
            </form>

            {{-- Listado de actividades ya registradas --}}
            <div class="mt-4">
                <h5 class="fw-bold">Actividades Registradas</h5>
                @forelse($agenda->actividades as $act)
                    <div class="alert alert-light border mb-2">
                        <strong>{{ $act->fecha_reporte->format('d/m/Y') }}:</strong> {{ Str::limit($act->actividades_ejecutar, 50) }}
                    </div>
                @empty
                    <div class="alert alert-info mt-2" style="background-color: #e0f4ff; border: none;">
                        No hay actividades registradas para esta agenda aún.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection