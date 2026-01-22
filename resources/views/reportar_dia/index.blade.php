<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex align-items-center">
            <i class="fas fa-calendar-check me-2 text-success"></i>
            {{ __('Mis Agendas - Reportar Actividades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container overflow-hidden">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0 fw-bold">Seleccione una agenda para reportar actividades</h5>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('formulario') }}" class="btn btn-success btn-sm rounded-pill px-3">
                                <i class="fas fa-plus me-1"></i> Nueva Agenda
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4"># ID</th>
                                    <th>Municipio Destino</th>
                                    <th>Ruta</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($agendas as $agenda)
                                    <tr>
                                        <td class="ps-4 fw-bold text-success">#{{ $agenda->id }}</td>
                                        <td>
                                            <span class="fw-semibold">{{ $agenda->municipio_destino }}</span>
                                        </td>
                                        <td><small class="text-muted">{{ $agenda->ruta }}</small></td>
                                        <td>{{ $agenda->fecha_inicio_desplazamiento }}</td>
                                        <td>{{ $agenda->fecha_fin_desplazamiento }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match ($agenda->estado) {
                                                    'ENVIADA' => 'bg-info text-dark',
                                                    'APROBADA' => 'bg-success',
                                                    'RECHAZADA' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} rounded-pill px-3">
                                                {{ $agenda->estado }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('reportar-dia.show', $agenda->id) }}"
                                                class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                <i class="fas fa-edit me-1"></i> Reportar
                                            </a>
                                            <a href="{{ route('agenda.pdf', $agenda->id) }}"
                                                class="btn btn-sm btn-light rounded-pill px-3 ms-1" target="_blank">
                                                <i class="fas fa-file-pdf text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                                <p class="mb-0">No has creado ninguna agenda todavía.</p>
                                                <a href="{{ route('formulario') }}"
                                                    class="btn btn-link text-success p-0">¡Crea tu primera agenda aquí!</a>
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
</x-app-layout>