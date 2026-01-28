@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Reportar Día</h2>
        <a href="{{ route('reportes') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-1"></i> Volver a la lista
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 mb-5">
        <div class="card-header text-white fw-bold py-3 px-4" style="background-color: #4b8a5f; border-radius: 15px 15px 0 0;">
            <i class="fas fa-info-circle me-2"></i> Detalles de Actividades para la Agenda #{{ $agenda->id }}
        </div>
        <div class="card-body p-4">
            {{-- Formulario de Registro --}}
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
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="medios_transporte[]" value="Aéreo" id="aereo">
                                <label class="form-check-label" for="aereo">Aéreo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="medios_transporte[]" value="Terrestre" id="terrestre">
                                <label class="form-check-label" for="terrestre">Terrestre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="medios_transporte[]" value="Fluvial" id="fluvial">
                                <label class="form-check-label" for="fluvial">Fluvial</label>
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

                <button type="submit" class="btn text-white w-100 fw-bold py-3 shadow-sm" style="background-color: #4b8a5f; border-radius: 10px;">
                    <i class="fas fa-save me-2"></i> Guardar Actividad
                </button>
            </form>

            {{-- SECCIÓN: Actividades Registradas con Columnas Identicas en Tamaño --}}
            <div class="mt-5">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0">Actividades Registradas</h5>
                    <hr class="flex-grow-1 ms-3 opacity-25">
                </div>
                
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        {{-- table-layout: fixed obliga a que las columnas respeten el % exacto --}}
                        <table class="table table-hover align-middle mb-0" style="table-layout: fixed; width: 100%;">
                            <thead style="background-color: #f8f9fa; border-bottom: 2px solid #eee;">
                                <tr class="text-dark">
                                    <th class="ps-4 py-3" style="width: 20%;">Fecha</th>
                                    <th class="py-3 text-center" style="width: 20%;">Actividad</th>
                                    <th class="py-3 text-center" style="width: 20%;">Transporte</th>
                                    <th class="py-3 text-center" style="width: 20%;">Despl. Internos</th>
                                    <th class="pe-4 py-3 text-center" style="width: 20%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agenda->actividades as $act)
                                    <tr>
                                        <td class="ps-4 py-4 text-dark fw-medium">
                                            {{ $act->fecha_reporte->format('d/m/Y') }}
                                        </td>
                                        <td class="py-4 text-center text-muted" style="word-wrap: break-word; white-space: normal;">
                                            {{ $act->actividades_ejecutar }}
                                        </td>
                                        <td class="py-4 text-center">
                                            <span class="badge rounded px-3 py-2 text-uppercase shadow-sm" 
                                                  style="background-color: #7dd3f7; color: #0c4a6e; font-weight: 800; font-size: 0.7rem; letter-spacing: 0.5px;">
                                                @if(is_array($act->medios_transporte))
                                                    {{ implode(', ', $act->medios_transporte) }}
                                                @else
                                                    {{ $act->medios_transporte }}
                                                @endif
                                            </span>
                                        </td>
                                        <td class="py-4 text-center text-dark">
                                            {{ $act->desplazamientos_internos ?? 'N/A' }}
                                        </td>
                                        <td class="pe-4 py-4 text-center">
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill" style="font-size: 0.75rem;">
                                                <i class="fas fa-check me-1"></i> Registrado
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <p class="mb-0">No hay actividades registradas aún.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection