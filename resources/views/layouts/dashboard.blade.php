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
    
    <style>
        :root {
            --brand: #39a900; 
            --ink: #1f3727ff;
            --border: #e5e7eb;
            --hover: #f1f5f9;
            /* Aumentamos el ancho del sidebar para equilibrar el texto grande */
            --sidebar-width: 22rem; 
        }

        /* Aumentamos la fuente base de todo el documento */
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
            gap: 1rem;
            padding: 1.2rem 1.5rem; /* Más espacio interno */
            border-radius: 0.75rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
            font-weight: 600; /* Texto más grueso */
            font-size: 1.2rem; /* Texto de menú más grande */
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
            width: 28px; /* Iconos más grandes */
            height: 28px;
            flex-shrink: 0;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 3rem; /* Más aire en el contenido */
            width: calc(100% - var(--sidebar-width));
        }

        /* LOGO MÁS GRANDE */
        .brand-logo {
            max-width: 180px; /* Aumentado de 140px */
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
            <a href="{{ route('inicio') }}" 
               class="{{ request()->routeIs('inicio') ? 'active-link' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/>
                </svg>
                <span>Inicio</span>
            </a>

            <a href="{{ route('formulario') }}" 
               class="{{ request()->routeIs('formulario') ? 'active-link' : '' }} mt-2">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
                <span>Formulario</span>
            </a>

            

            <a href="{{ route('reportes') }}" 
               class="{{ request()->routeIs('reportes') ? 'active-link' : '' }} mt-2">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M4 20h16M7 16v-6M12 16v-9M17 16v-3"/>
                </svg>
                <span>Reportes</span>
            </a>
        </nav>

        <div class="mt-auto pb-4">
            <button class="btn btn-outline-danger w-100 fw-bold btn-logout shadow-sm">
                Cerrar sesión
            </button>
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