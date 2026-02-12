@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Gestión Técnica de Viáticos</h2>
        <p class="text-muted">Valida los soportes y liquida las agendas autorizadas por coordinación.</p>
    </div>

    {{-- Resumen de Estados (Filtros Visuales) --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-warning bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 small fw-bold text-warning text-uppercase">Para Liquidar</p>
                        <h2 class="fw-bold mb-0 text-dark">{{ $agendas->where('estado', 'APROBADA_COORDINADOR')->count() }}</h2>
                    </div>
                    <i class="fas fa-file-invoice-dollar fa-2x text-warning"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-success bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 small fw-bold text-success text-uppercase">Liquidadas</p>
                        <h2 class="fw-bold mb-0 text-dark">{{ $agendas->where('estado', 'LIQUIDADA')->count() }}</h2>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-danger bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 small fw-bold text-danger text-uppercase">Devueltas</p>
                        <h2 class="fw-bold mb-0 text-dark">{{ $agendas->where('estado', 'ENVIADA')->count() }}</h2>
                    </div>
                    <i class="fas fa-undo-alt fa-2x text-danger"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de Gestión --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Contratista</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $agenda->user->name }}</div>
                                <div class="small text-muted">ID: #{{ $agenda->id }}</div>
                            </td>
                            <td>{{ $agenda->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($agenda->estado == 'APROBADA_COORDINADOR')
                                    <span class="badge bg-warning text-dark rounded-pill">Pendiente Liquidar</span>
                                @elseif($agenda->estado == 'LIQUIDADA')
                                    <span class="badge bg-success rounded-pill">Liquidada</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill">En Proceso</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-dark btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalGestion{{ $agenda->id }}">
                                    <i class="fas fa-eye me-1"></i> Gestionar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Incluir Modales de Gestión --}}
@foreach($agendas as $agenda)
    @include('viaticos.partials.modal_gestion', ['agenda' => $agenda])
@endforeach

@endsection