@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container-fluid mt-3">
    <div class="card border shadow-sm mb-4">
        <div class="card-body d-flex align-items-center justify-content-center py-3 mt-3">
            <img src="{{ asset('img/logo250.png') }}" alt="SENA" style="height: 60px; margin-right: 20px;">
            <h1 class="h2 mb-0 fw-bold text-dark" style="letter-spacing: -1px;">Agenda CTGI</h1>
        </div>
    </div>

    <div class="card border-0 shadow bg-success text-white mb-5 ">
        <div class="card-body py-5 px-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-3 text-white">
                        {{-- Si no tienes login activo aún, puedes poner "Usuario" --}}
                        ¡Bienvenid@, {{ auth()->check() ? auth()->user()->name : 'Usuario' }}!
                    </h1>
                    <p class="lead mb-4 text-white">
                        Gestión de formularios y permisos con reportes de manera eficiente y segura con nuestro sistema moderno.
                    </p>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="fas fa-calendar-check fa-5x text-white opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <section class="mb-4">
        <h4 class="fw-bold mb-3 ms-2 text-dark">
            <i class="fas fa-rocket me-2 text-primary mt-3"></i>Accesos Rápidos
        </h4>
        <div class="row g-3 mt-3">
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('inicio') }}" class="text-decoration-none">
                    <div class="card h-100 border border-primary shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-home fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mt-2">Inicio</h5>
                            <p class="card-text text-muted small">Panel principal</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('formulario') }}" class="text-decoration-none">
                    <div class="card h-100 border border-success shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-file-alt fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mt-2">Formulario</h5>
                            <p class="card-text text-muted small">Registrar nueva agenda</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card h-100 border border-warning shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-comment-dots fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mt-2">Observaciones</h5>
                            <p class="card-text text-muted small">Ver novedades registradas</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('reportes') }}" class="text-decoration-none">
                    <div class="card h-100 border border-info shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-chart-bar fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mt-2">Reportes</h5>
                            <p class="card-text text-muted small">Estadísticas y descargas</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>

<style>
    .card-hover:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .bg-success {
        background-color: #39a900 !important; /* Verde SENA */
    }
</style>
@endsection