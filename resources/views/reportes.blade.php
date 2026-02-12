@extends('layouts.dashboard')

@section('content')
<div class="py-4">
    <div class="container-fluid px-md-5 overflow-hidden">

        {{-- SECCIÓN DEL TÍTULO --}}
        <div class="mt-3">
            <div class="card border shadow-sm mb-4">
                <div class="card-body d-flex align-items-center justify-content-center py-3">
                    <img src="{{ asset('img/logo250.png') }}" alt="SENA" style="height: 60px; margin-right: 20px;">
                    <h1 class="h2 mb-0 fw-bold text-dark" style="letter-spacing: -1px;">Agenda CTGI</h1>
                </div>
            </div>
        </div>
    </div>

    {{-- CARD PRINCIPAL DE LA TABLA --}}
    <div class="container-fluid px-md-5 overflow-hidden">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    Seleccione una agenda para reportar actividades
                </h5>
                @if(auth()->user()->role == 'contratista')
                    <a href="{{ route('formulario') }}" class="btn btn-success">Nueva Agenda</a>
                @endif
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #23d647ff; border-bottom: 2px solid #eee;">
                            <tr class="text-dark">
                                <th class="ps-4 py-3"># IDENTIFICACIÓN</th>
                                <th class="py-3">Municipio Destino</th>
                                <th class="py-3">Ruta</th>
                                <th class="py-3">Fecha de inicio</th>
                                <th class="py-3">Fecha final</th>
                                <th class="py-3 text-center" style="width: 250px;">Estado</th>
                                <th class="text-end pe-4 py-3">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($agendas as $agenda)
                                <tr>
                                    <td class="ps-4 fw-bold text-success">
                                        #{{ $agenda->id }}
                                    </td>

                                    <td class="fw-bold text-dark text-uppercase">
                                        {{ $agenda->municipio_destino }}
                                    </td>

                                    <td>
                                        <span style="color: #999; font-size: 0.85rem; text-transform: uppercase; font-weight: 500;">
                                            {{ $agenda->ruta ?? 'MEDELLÍN - ' . $agenda->municipio_destino . ' - MEDELLÍN' }}
                                        </span>
                                    </td>

                                    <td class="text-dark">
                                        {{ \Carbon\Carbon::parse($agenda->fecha_inicio_desplazamiento)->translatedFormat('j \d\e F \d\e Y') }}
                                    </td>

                                    <td class="text-dark">
                                        {{ \Carbon\Carbon::parse($agenda->fecha_fin_desplazamiento)->translatedFormat('j \d\e F \d\e Y') }}
                                    </td>

                                    <td class="text-center">
                                        {{-- LÓGICA DE DEVOLUCIÓN --}}
                                        @if($agenda->estado == 'ENVIADA' && $agenda->observaciones_finanzas)
                                            <div class="alert alert-danger mb-0 py-1 px-2 shadow-sm" style="font-size: 0.75rem; border-left: 4px solid #dc3545;">
                                                <strong class="d-block text-uppercase"><i class="fas fa-undo-alt me-1"></i> Devuelta</strong>
                                                <span class="text-dark">{{ $agenda->observaciones_finanzas }}</span>
                                            </div>
                                        @else
                                            @php
                                                $estadoAMostrar = $agenda->estado ?: 'ENVIADA';
                                                $colores = match(strtoupper($estadoAMostrar)) {
                                                    'APROBADA_COORDINADOR', 'LIQUIDADA' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                                                    'APROBADA_SUBDIRECTOR' => ['bg' => '#39a900', 'text' => '#ffffff'],
                                                    'RECHAZADA' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                                    default     => ['bg' => '#7dd3f7', 'text' => '#0c4a6e'],
                                                };
                                            @endphp

                                            <span class="badge rounded px-3 py-2 text-uppercase" 
                                                  style="background-color: {{ $colores['bg'] }}; color: {{ $colores['text'] }}; font-weight: 800; font-size: 0.72rem; letter-spacing: 0.5px;">
                                                {{ str_replace('_', ' ', $estadoAMostrar) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('reportes.show', $agenda->id) }}"
                                               class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold shadow-sm">
                                                {{ ($agenda->estado == 'ENVIADA' && $agenda->observaciones_finanzas) ? 'Corregir' : 'Reportar' }}
                                            </a>

                                            <a href="{{ route('agenda.pdf', $agenda->id) }}" 
                                                class="btn btn-sm btn-light rounded-pill border shadow-sm px-2" 
                                                target="_blank" title="Ver PDF">
                                                <i class="fas fa-file-pdf text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                            <p class="mb-0">No hay agendas registradas.</p>
                                        </div>
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
@endsection