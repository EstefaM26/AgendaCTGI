<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fuentes opcionales -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <!-- Bootstrap compilado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />


    <style>
        :root {
            --brand: #39a900;
            --ink: #1f2937;
            --border: #e5e7eb;
            --hover: #f8fafc;
        }

        body {
            background: #f8fafc;
        }

        .sidebar {
            width: 20rem;
            min-height: 100vh;
            background: #fff;
            color: var(--ink);
            border-right: 1px solid var(--border);
        }

        .sidebar a {
            color: var(--ink);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.55rem 0.65rem;
            border-radius: 0.5rem;
            background: transparent;
            border: 1px solid transparent;
            margin-bottom: 0.35rem;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
            font-size: 1rem;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: var(--hover);
            border-color: var(--border);
            color: #0f172a;
            box-shadow: none;
        }

        .content {
            padding: 1.5rem;
        }

        .mobile-nav a {
            color: var(--ink);
            background: transparent;
            border-radius: 0.5rem;
            padding: 0.55rem 0.65rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            border: 1px solid transparent;
            margin-bottom: 0.35rem;
            text-decoration: none;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }

        .mobile-nav a:hover {
            background: var(--hover);
            border-color: var(--border);
            color: #0f172a;
            box-shadow: none;
        }

        .nav-icon {
            width: 22px;
            height: 22px;
            color: var(--brand);
            flex-shrink: 0;
        }

        .btn {
            transition: transform 0.15s ease, box-shadow 0.15s ease, filter 0.15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1rem -0.75rem rgba(0, 0, 0, 0.35);
            filter: brightness(0.97);
        }

        .brand-logo {
            width: 100%;
            max-width: 200px;
            height: auto;
        }

        @media (min-width: 992px) {
            .content {
                margin-left: 20rem;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar desktop -->
    <aside class="sidebar d-none d-lg-flex flex-column position-fixed top-0 start-0 p-3">
        <div class="d-flex align-items-center justify-content-center mb-3">
            <a href="{{ route('formulario') }}" class="text-decoration-none">
                <img src="{{ asset('images/sena/logo250.png') }}" class="brand-logo" alt="SENA"
                    style="max-width: 100px;">
            </a>
        </div>
        <nav class="flex-grow-1">
            <a href="{{ route('formulario') }}"
                class="nav-link px-2 py-2 rounded {{ request()->routeIs('formulario') ? 'bg-success text-white shadow-sm' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M3 21h18" />
                    <path d="M5 21V7l7-4 7 4v14" />
                    <path d="M9 21v-6h6v6" />
                </svg>
                <span>Crear Agenda</span>
            </a>
            <a href="{{ route('reportar-dia') }}"
                class="nav-link px-2 py-2 rounded {{ request()->routeIs('reportar-dia*') ? 'bg-success text-white shadow-sm' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="7" r="3.5" />
                    <path d="M4 21c1.5-4 5-6 8-6s6.5 2 8 6" />
                </svg>
                <span>Reportar Dias</span>
            </a>
            <a href="{{ route('reportar-dia') }}"
                class="nav-link px-2 py-2 rounded {{ request()->routeIs('reportar-dia*') ? 'bg-success text-white shadow-sm' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="7" y="4" width="10" height="16" rx="2" />
                    <path d="M9 4V2h6v2" />
                    <path d="M9 10h6" />
                    <path d="M9 14h6" />
                </svg>
                <span>Estado Agenda</span>
            </a>
            <a href="{{ route('formulario') }}"
                class="nav-link px-2 py-2 rounded {{ request()->routeIs('formulario') ? 'bg-success text-white shadow-sm' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 20h16" />
                    <path d="M7 16v-6" />
                    <path d="M12 16v-9" />
                    <path d="M17 16v-3" />
                </svg>
                <span>Reportes</span>
            </a>
        </nav>
        <div class="mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100 text-start fw-semibold text-white">
                    Cerrar sesion
                </button>
            </form>
        </div>
    </aside>

    <!-- Offcanvas mobile -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu"
        style="--bs-offcanvas-width: 20rem; background: #fff;">
        <div class="offcanvas-header">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <img src="{{ asset('images/sena/logo250.png') }}" class="brand-logo" alt="SENA"
                    style="max-width: 100px;">
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <nav class="flex-grow-1 mobile-nav">
                <a href="{{ route('formulario') }}"
                    class="{{ request()->routeIs('formulario') ? 'bg-success text-white shadow-sm' : '' }}">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 21h18" />
                        <path d="M5 21V7l7-4 7 4v14" />
                        <path d="M9 21v-6h6v6" />
                    </svg>
                    <span>Ambiente</span>
                </a>
                <a href="{{ route('reportar-dia') }}"
                    class="{{ request()->routeIs('reportar-dia*') ? 'bg-success text-white shadow-sm' : '' }}">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="7" r="3.5" />
                        <path d="M4 21c1.5-4 5-6 8-6s6.5 2 8 6" />
                    </svg>
                    <span>Reportar Dias</span>
                </a>
                <a href="{{ route('reportar-dia') }}"
                    class="{{ request()->routeIs('reportar-dia*') ? 'bg-success text-white shadow-sm' : '' }}">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="7" y="4" width="10" height="16" rx="2" />
                        <path d="M9 4V2h6v2" />
                        <path d="M9 10h6" />
                        <path d="M9 14h6" />
                    </svg>
                    <span>Prestamos</span>
                </a>
                <a href="{{ route('formulario') }}"
                    class="{{ request()->routeIs('formulario') ? 'bg-success text-white shadow-sm' : '' }}">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 20h16" />
                        <path d="M7 16v-6" />
                        <path d="M12 16v-9" />
                        <path d="M17 16v-3" />
                    </svg>
                    <span>Reportes</span>
                </a>
            </nav>
            <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 text-start fw-semibold text-white">
                        Cerrar sesion
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <div class="d-lg-none mb-3">
            <button class="btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                aria-controls="mobileMenu">
                <img src="{{ asset('images/sena/logo250.png') }}" alt="SENA" style="height: 20px; margin-right: 8px;">
                Menú
            </button>
        </div>

        @if (isset($header))
            <div class="card mb-3 shadow-sm">
                <div class="card-body py-3">
                    {{ $header }}
                </div>
            </div>
        @endif

        {{ $slot }}
    </div>



    {{-- Slot para scripts --}}
    {{ $scripts ?? '' }}


</body>

</html>