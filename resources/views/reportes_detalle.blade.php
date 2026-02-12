@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Detalle de Actividades</h2>
        {{-- Se cambió route() por url() para evitar el error de ruta no definida --}}
        <a href="{{ url('/reportes') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-1"></i> Volver al Historial
        </a>
    </div>

    {{-- SECCIÓN: ALERTA DE DEVOLUCIÓN POR VIÁTICOS --}}
    @if($agenda->estado == 'ENVIADA' && $agenda->observaciones_finanzas)
        <div class="alert alert-danger border-start border-danger border-4 shadow-sm mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-2x me-3 text-danger"></i>
                <div>
                    <h5 class="fw-bold mb-1">Agenda Devuelta para Corrección</h5>
                    <p class="mb-0 text-dark">{{ $agenda->observaciones_finanzas }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4 mb-5">
        <div class="card-header text-white fw-bold py-3 px-4" style="background-color: #39a900; border-radius: 15px 15px 0 0;">
            <i class="fas fa-info-circle me-2"></i> Información de la Agenda #{{ $agenda->id }}
        </div>
        <div class="card-body p-4">
            
            {{-- FORMULARIO DE REGISTRO (Para Contratistas o Administradores en estado ENVIADA) --}}
            @php $userRole = auth()->user()->role; @endphp
            @if(($userRole == 'contratista' || $userRole == 'administrador') && $agenda->estado == 'ENVIADA')
                <div class="bg-light p-4 rounded-4 mb-5 border">
                    <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-plus-circle me-1"></i> Registrar Nueva Actividad</h5>
                    <form action="{{ route('actividades.store', $agenda->id) }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Día a reportar</label>
                                <input type="date" name="fecha_reporte" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Medio de transporte</label>
                                <div class="d-flex gap-3 mt-2">
                                    @foreach(['Aéreo', 'Terrestre', 'Fluvial'] as $medio)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="medios_transporte[]" value="{{ $medio }}" id="m_{{ $medio }}">
                                            <label class="form-check-label" for="m_{{ $medio }}">{{ $medio }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Actividades ejecutadas</label>
                                <textarea name="actividades_ejecutar" class="form-control" rows="3" placeholder="Describa lo realizado..." required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Desplazamientos Internos</label>
                                <input type="text" name="desplazamientos_internos" class="form-control" placeholder="Lugar o N/A">
                            </div>
                        </div>
                        <button type="submit" class="btn text-white w-100 fw-bold py-3 shadow-sm" style="background-color: #39a900; border-radius: 10px;">
                            <i class="fas fa-save me-2"></i> GUARDAR ACTIVIDAD
                        </button>
                    </form>
                </div>
            @endif

            {{-- TABLA DE ACTIVIDADES REGISTRADAS --}}
            <div class="mt-2">
                <h5 class="fw-bold text-dark mb-3">Actividades Reportadas</h5>
                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 15%;">Fecha</th>
                                <th style="width: 45%;">Actividad</th>
                                <th style="width: 20%;">Transporte</th>
                                <th style="width: 20%;">Despl. Internos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agenda->actividades as $act)
                                <tr>
                                    <td class="fw-bold text-primary">
                                        {{ is_object($act->fecha_reporte) ? $act->fecha_reporte->format('d/m/Y') : date('d/m/Y', strtotime($act->fecha_reporte)) }}
                                    </td>
                                    <td>{{ $act->actividades_ejecutar }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ is_array($act->medios_transporte) ? implode(', ', $act->medios_transporte) : $act->medios_transporte }}
                                        </span>
                                    </td>
                                    <td>{{ $act->desplazamientos_internos ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x d-block mb-3 opacity-25"></i>
                                        Aún no hay actividades registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- --- SECCIÓN: FIRMA DEL COORDINADOR CON PREVISUALIZACIÓN --- --}}
            @if(auth()->user()->role == 'coordinador' && $agenda->estado == 'ENVIADA')
                <div class="mt-5 p-4 border-top border-primary border-3 bg-primary bg-opacity-10 rounded-4 shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="fw-bold text-primary"><i class="fas fa-file-signature me-2"></i>Área de Firma Autorizada</h4>
                            <p class="text-dark mb-4">Antes de firmar, asegúrese de revisar el contenido del reporte en PDF.</p>
                            
                            {{-- BOTÓN PARA REVISAR PDF --}}
                            <a href="{{ route('agenda.pdf', $agenda->id) }}" target="_blank" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                                <i class="fas fa-file-pdf me-2"></i> REVISAR PDF ANTES DE FIRMAR
                            </a>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <form action="{{ route('agenda.autorizar', $agenda->id) }}" method="POST" enctype="multipart/form-data" class="card card-body shadow-sm border-0 rounded-4">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">IMAGEN DE FIRMA (PNG/JPG)</label>
                                    <input type="file" name="firma_archivo" class="form-control" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 fw-bold py-2" onclick="return confirm('¿Ha validado el PDF y desea aprobar este reporte?')">
                                    <i class="fas fa-check-double me-1"></i> Firmar y Aprobar Agenda
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            
            {{-- VISTA DE FIRMA YA CARGADA --}}
            @if($agenda->firma_supervisor)
                <div class="mt-5 text-center border-top pt-4">
                    <p class="text-muted small mb-1">Firmado electrónicamente por Coordinación</p>
                    <img src="{{ asset('storage/' . $agenda->firma_supervisor) }}" alt="Firma Coordinador" style="max-height: 100px;">
                    <p class="fw-bold mt-2 mb-0 text-success" style="font-size: 0.8rem;">Avalado el: {{ $agenda->fecha_firma_coordinador }}</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection