<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <img src="{{ asset('images/sena/logo250.png') }}" alt="SENA" style="height: 40px; margin-right: 10px;">
            <span class="h5 mb-0 fw-bold">{{ __('Llaves CTGI') }}</span>
        </div>
    </x-slot>

    <div class="card border-0 shadow bg-success text-white mb-4">
        <div class="card-body py-5 px-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-3 text-white">
                        Bienvenid@, {{ auth()->user()->name }}!
                    </h1>
                    <p class="lead mb-4 text-white">
                        Gestiona ambientes, instructores y préstamos de manera eficiente y segura con nuestro sistema
                        moderno.
                    </p>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="fas fa-key fa-5x text-white opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos Rápidos -->
    <section class="mb-4">
        <h4 class="fw-bold mb-3 ms-2">
            <i class="fas fa-rocket me-2 text-primary"></i>Accesos Rápidos
        </h4>
        <div class="row g-3">
            <!-- Card: Ambientes -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('formulario') }}" class="text-decoration-none">
                    <div class="card h-100 border border-primary shadow-sm">
                        <div class="card-body text-center p-4">
                            <div
                                class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-building fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark">Nueva Agenda</h5>
                            <p class="card-text text-muted small">Crear una nueva agenda de desplazamiento</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card: Instructores -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('reportar-dia') }}" class="text-decoration-none">
                    <div class="card h-100 border border-success shadow-sm">
                        <div class="card-body text-center p-4">
                            <div
                                class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-calendar-check fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark">Reportar Días</h5>
                            <p class="card-text text-muted small">Registrar actividades diarias</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card: Préstamos -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('reportar-dia') }}" class="text-decoration-none">
                    <div class="card h-100 border border-warning shadow-sm">
                        <div class="card-body text-center p-4">
                            <div
                                class="bg-warning bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-tasks fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark">Estado Agenda</h5>
                            <p class="card-text text-muted small">Ver seguimiento de agendas</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card: Reportes -->
            <div class="col-md-6 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card h-100 border border-info shadow-sm">
                        <div class="card-body text-center p-4">
                            <div
                                class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-chart-bar fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark">Reportes</h5>
                            <p class="card-text text-muted small">Ver estadísticas y reportes</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
</x-app-layout>