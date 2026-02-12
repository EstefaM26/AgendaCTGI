<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3" style="width: 100px;">Folio</th>
                        <th>Funcionario</th>
                        <th>Destino</th>
                        <th>Fecha Inicio</th>
                        @if($tipo == 'devueltas')
                            <th class="text-danger fw-bold">Motivo del Rechazo (Viáticos)</th>
                        @endif
                        <th class="text-end pe-4">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lista as $item)
                    <tr style="transition: all 0.2s;">
                        <td class="ps-4">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border">
                                #{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->nombre_completo }}</div>
                            <div class="text-muted" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $item->cargo }}
                            </div>
                        </td>
                        <td>
                            <span class="text-dark"><i class="fas fa-map-marker-alt text-danger me-1 small"></i>{{ $item->municipio_destino }}</span>
                        </td>
                        <td>
                            <div class="text-dark">{{ $item->fecha_inicio_desplazamiento->format('d/m/Y') }}</div>
                        </td>
                        
                        {{-- COLUMNA DINÁMICA DE RECHAZO --}}
                        @if($tipo == 'devueltas')
                            <td>
                                <div class="p-2 rounded-3 border-start border-danger border-4 bg-danger bg-opacity-10 text-danger" style="font-size: 0.85rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    <strong>Nota:</strong> {{ $item->observaciones_finanzas ?? 'No se especificó un motivo.' }}
                                </div>
                            </td>
                        @endif

                        <td class="text-end pe-4">
                            @if($tipo == 'pendientes')
                                <a href="{{ route('reportes.show', $item->id) }}"
                                   class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm fw-bold">
                                   <i class="fas fa-pen-nib me-1"></i> Firmar Agenda
                                </a>
                            @elseif($tipo == 'devueltas')
                                <a href="{{ route('reportes.show', $item->id) }}"
                                   class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm fw-bold">
                                   <i class="fas fa-sync me-1"></i> Corregir y Firmar
                                </a>
                            @else
                                <a href="{{ route('reportes.show', $item->id) }}"
                                   class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                   <i class="fas fa-eye me-1"></i> Ver Detalles
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $tipo == 'devueltas' ? '6' : '5' }}" class="text-center py-5">
                            <div class="opacity-50">
                                <i class="fas fa-folder-open fa-3x mb-3 text-muted"></i>
                                <p class="text-muted fw-bold">No hay agendas registradas en esta categoría.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>