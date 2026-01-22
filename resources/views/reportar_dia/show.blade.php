<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Reportar Día') }}
            </h2>
            <a href="{{ route('reportar-dia') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            @isset($agenda)
                <div class="card mb-5 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Detalles de Actividades para la Agenda #{{ $agenda->id }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('agenda.actividad.store', $agenda->id) }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Día a reportar</label>
                                    <input type="date" name="fecha_reporte" class="form-control"
                                        min="{{ $agenda->fecha_inicio_desplazamiento }}"
                                        max="{{ $agenda->fecha_fin_desplazamiento }}" required>

                                    <label class="form-label mt-2 fw-bold">Ruta</label>
                                    <input type="text" class="form-control bg-light" value="{{ $agenda->ruta }}" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Medio de transporte</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="medios_transporte[]"
                                                value="area">
                                            <label class="form-check-label">Aéreo</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="medios_transporte[]"
                                                value="terrestre">
                                            <label class="form-check-label">Terrestre</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="medios_transporte[]"
                                                value="fluvial">
                                            <label class="form-check-label">Fluvial</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Actividades a ejecutar</label>
                                    <textarea name="actividades_ejecutar" class="form-control" maxlength="160" rows="4"
                                        placeholder="Describa las actividades realizadas..." required></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Desplazamientos Internos</label>
                                    <input type="text" name="desplazamientos_internos" class="form-control"
                                        placeholder="Lugar o N/A">

                                    <label class="form-label mt-2 fw-bold">Destino Final</label>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ $agenda->municipio_destino }} - MEDELLÍN" readonly>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Observaciones</label>
                                    <textarea name="observaciones" class="form-control" rows="3"
                                        placeholder="Ej: Se liquidan gastos de transporte intermunicipal por valor de $..."></textarea>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <button type="submit" class="btn btn-success w-100 fw-bold">
                                        Guardar Actividad
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if($agenda->actividades->count() > 0)
                            <div class="mt-5">
                                <h5 class="fw-bold border-bottom pb-2">Actividades Registradas</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Actividad</th>
                                                <th>Transporte</th>
                                                <th>Despl. Internos</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($agenda->actividades as $actividad)
                                                <tr>
                                                    <td class="text-nowrap">{{ $actividad->fecha_reporte->format('Y-m-d') }}</td>
                                                    <td>
                                                        <span title="{{ $actividad->actividades_ejecutar }}">
                                                            {{ Str::limit($actividad->actividades_ejecutar, 50) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @foreach($actividad->medios_transporte as $medio)
                                                            <span class="badge bg-info text-dark">{{ ucfirst($medio) }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $actividad->desplazamientos_internos ?? 'N/A' }}</td>
                                                    <td>
                                                        {{-- Botones de acción si se necesitan --}}
                                                        <span class="text-muted small">Registrado</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info mt-4">
                                No hay actividades registradas para esta agenda aún.
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    No se ha seleccionado una agenda válida.
                </div>
            @endisset
        </div>
    </div>
</x-app-layout>