<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Agenda CTGI</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --brand: #39a900; 
            --ink: #1f3727ff;
            --border: #e5e7eb;
            --hover: #f1f5f9;
            --sidebar-width: 22rem; 
        }

        html { font-size: 18px; } 

        body { 
            background: #f8fafc; 
            margin: 0; 
            font-family: 'Figtree', sans-serif;
            color: var(--ink);
        }
        
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: #fff;
            color: var(--ink);
            border-right: 2px solid var(--border);
            z-index: 1000;
        }
        
        .sidebar a {
            color: var(--ink);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 1.5rem;
            border-radius: 0.75rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .sidebar a:hover {
            background: var(--hover);
            color: var(--brand);
            transform: translateX(5px);
        }

        .sidebar a.active-link {
            background: var(--brand) !important;
            color: white !important;
            box-shadow: 0 10px 15px -3px rgba(57, 169, 0, 0.3);
        }

        .nav-icon {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 3rem;
            width: calc(100% - var(--sidebar-width));
        }

        .brand-logo {
            max-width: 180px;
            height: auto;
            transition: transform 0.3s ease;
        }
        
        .brand-logo:hover {
            transform: scale(1.05);
        }

        .btn-logout {
            font-size: 1.1rem;
            padding: 0.8rem;
            border-width: 2px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <aside class="sidebar d-flex flex-column position-fixed top-0 start-0 p-4">
        
        <div class="text-center mb-5 mt-2">
            <img src="{{ asset('img/logo250.png') }}" class="brand-logo mb-3" alt="SENA">
            <hr class="mx-4 opacity-10">
        </div>

        <nav class="flex-grow-1">
            {{-- ENLACE: INICIO --}}
            <a href="{{ route('inicio') }}" 
            class="{{ request()->routeIs('inicio') ? 'active-link' : '' }}">
                <div class="d-flex align-items-center gap-3">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/>
                    </svg>
                    <span>Inicio</span>
                </div>
            </a>

            {{-- ENLACE: FORMULARIO (Contratista o Administrador) --}}
            @if(auth()->user()->role == 'contratista' || auth()->user()->role == 'administrador')
            <a href="{{ route('formulario') }}" 
            class="{{ request()->routeIs('formulario') ? 'active-link' : '' }} mt-2">
                <div class="d-flex align-items-center gap-3">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span>Formulario</span>
                </div>
            </a>
            @endif

            {{-- ENLACE: POR AUTORIZAR (Coordinador o Subdirector) - SIN ALERTAS --}}
            @if(auth()->user()->role == 'coordinador' || auth()->user()->role == 'subdirector')
                @php 
                    $rutaMenu = (auth()->user()->role == 'coordinador') ? route('coordinador.index') : route('subdirector.index');
                @endphp
                
                <a href="{{ $rutaMenu }}" 
                class="{{ request()->routeIs('coordinador.index') || request()->routeIs('subdirector.index') ? 'active-link' : '' }} mt-2">
                    <div class="d-flex align-items-center gap-3">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span>Por Autorizar</span>
                    </div>
                </a>
            @endif

            {{-- ENLACE UNIFICADO: REPORTES / GESTIÓN VIÁTICOS - SIN ALERTAS --}}
            <a href="{{ route('reportes') }}" 
            class="{{ request()->routeIs('reportes') || request()->routeIs('reportes.show') ? 'active-link' : '' }} mt-2">
                <div class="d-flex align-items-center gap-3">
                    @if(auth()->user()->role == 'viaticos')
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Gestión Viáticos</span>
                    @else
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M4 20h16M7 16v-6M12 16v-9M17 16v-3"/>
                        </svg>
                        <span>Reportes</span>
                    @endif
                </div>
            </a>
        </nav>

        <div class="mt-auto pt-4 border-top">
            <div class="d-flex align-items-center gap-3 mb-4 px-2">
                <div class="bg-light rounded-circle p-2 text-center" style="width: 45px; height: 45px;">
                    <i class="fas fa-user text-muted"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="mb-0 fw-bold text-truncate small">{{ auth()->user()->name }}</p>
                    <p class="mb-0 text-muted small text-uppercase" style="font-size: 0.65rem;">{{ auth()->user()->role }}</p>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 fw-bold btn-logout rounded-3">
                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="content">
        @yield('content')
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>