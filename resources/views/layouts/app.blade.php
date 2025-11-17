<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- El token CSRF se mantiene para la funcionalidad de Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIG-Académico | @yield('title', 'Inicio')</title>

    <!-- Carga de Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FUENTES: Inter (general) y Orbitron (para títulos y números, estilo Sci-Fi) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome (Íconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJc5f85U1uJ6W9aA/w4gB5w+8w7kYm6T9N/m1jYvC+A3nNn/d3l+B4gXg8fQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Definiciones de Variables CSS para el Tema Dark/Neon */
        :root {
            /* Colores Base del tema */
            --dark-bg: #0d0e13; /* Fondo principal muy oscuro */
            --dark-surface: #1a1c22; /* Fondo de contenedores y tarjetas */
            --nav-bg: #212529; /* Fondo de la barra de navegación (manteniendo el original) */
            --nav-text: #f8f9fa; /* Texto de la barra de navegación */
            --nav-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);

            /* Colores Neón */
            --neon-blue: #00BFFF; /* Cursos */
            --neon-green: #39FF14; /* Docentes */
            --neon-cyan: #00FFFF; /* Alumnos */
            --neon-purple: #C800FF; /* Matrículas */
            --neon-text: var(--neon-cyan); /* Color de texto principal en el cuerpo */
        }

        /* Estilos base de la barra de navegación */
        .custom-navbar {
            background-color: var(--nav-bg);
            color: var(--nav-text);
            box-shadow: var(--nav-shadow);
            font-family: 'Inter', sans-serif;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* Estilo base para el body (Ahora oscuro) */
        body {
            background-color: var(--dark-bg);
            color: var(--nav-text); /* Texto general claro */
            font-family: 'Inter', sans-serif;
        }

        .nav-link {
            color: var(--nav-text);
            padding: 0.5rem 1rem;
            transition: color 0.15s ease-in-out;
            text-decoration: none; 
            display: inline-flex;
            align-items: center;
        }
        .nav-link:hover {
            color: #adb5bd; /* Lighter text on hover */
        }
        .navbar-brand {
             color: var(--nav-text);
             font-size: 1.25rem;
             font-weight: 700;
             font-family: 'Orbitron', sans-serif; /* Marca con fuente Sci-Fi */
        }
        .dropdown-menu {
            right: 0;
            left: auto;
        }
        .main-padding {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
    </style>

    <!-- Configuración de Tailwind para reconocer los colores Neón y fondos oscuros -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': 'var(--dark-bg)',
                        'dark-card': 'var(--dark-surface)',
                        'neon-blue': 'var(--neon-blue)',
                        'neon-green': 'var(--neon-green)',
                        'neon-cyan': 'var(--neon-cyan)',
                        'neon-purple': 'var(--neon-purple)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Orbitron', 'sans-serif'], // Fuente Sci-Fi para el Dashboard
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-dark-bg text-gray-100">
    <div id="app">
        <!-- BARRA DE NAVEGACIÓN (Simulando navbar-dark bg-dark shadow-sm) -->
        <nav class="custom-navbar">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Brand y Toggle -->
                    <div class="flex items-center">
                        <a class="navbar-brand nav-link" href="{{ url('/') }}">
                            <i class="fas fa-graduation-cap mr-2 text-neon-cyan"></i> SIG-Académico
                        </a>
                    </div>
                    
                    <!-- Botón Toggler para móvil -->
                    <div class="md:hidden">
                        <button id="nav-toggle" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Abrir menú principal</span>
                            <!-- Icono de Hamburguesa/Cerrar (simulando navbar-toggler-icon) -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>

                    <!-- Menú Principal (Escritorio) -->
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            
                            @auth
                                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

                                {{-- ENLACES ADMINISTRADOR --}}
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('alumnos.index') }}" class="nav-link">Alumnos</a>
                                    <a href="{{ route('docentes.index') }}" class="nav-link">Docentes</a>
                                    <a href="{{ route('cursos.index') }}" class="nav-link">Cursos</a>
                                @endif

                                {{-- ENLACES DOCENTE --}}
                                @if (Auth::user()->role === 'docente')
                                    <a href="{{ route('alumnos.index') }}" class="nav-link">Alumnos</a>
                                    <a href="{{ route('cursos.index') }}" class="nav-link">Mis Cursos</a>
                                @endif

                                {{-- ENLACES DE MATRÍCULAS (Admin y Alumno) --}}
                                @if (in_array(Auth::user()->role, ['admin', 'alumno']))
                                    <a href="{{ route('matriculas.index') }}" class="nav-link">Matrículas</a>
                                @endif
                            
                        </div>
                    </div>

                    <!-- Right Side Of Navbar (Perfil y Logout) -->
                    <div class="hidden md:block ml-4">
                        <div class="relative">
                            <button id="profile-menu-button" type="button" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white nav-link" aria-expanded="false" aria-haspopup="true">
                                {{-- Nombre de Usuario y Rol --}}
                                {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="profile-dropdown" class="origin-top-right absolute hidden right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>
                                <!-- Formulario de Logout (oculto) -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>

                </div>
            </div>

            <!-- Menú Móvil (inicialmente oculto) -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-white">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700">Dashboard</a>
                        
                        {{-- ENLACES ADMINISTRADOR --}}
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('alumnos.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700">Alumnos</a>
                            <a href="{{ route('docentes.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700">Docentes</a>
                            <a href="{{ route('cursos.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700">Cursos</a>
                        @endif

                        {{-- ENLACES DOCENTE --}}
                        @if (Auth::user()->role === 'docente')
                            <a href="{{ route('alumnos.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700">Alumnos</a>
                            <a href="{{ route('cursos.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700">Mis Cursos</a>
                        @endif

                        {{-- ENLACES DE MATRÍCULAS (Admin y Alumno) --}}
                        @if (in_array(Auth::user()->role, ['admin', 'alumno']))
                            <a href="{{ route('matriculas.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700">Matrículas</a>
                        @endif

                        {{-- Logout en móvil --}}
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-700 mt-2 border-t border-gray-700 pt-2"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ Auth::user()->name }} | Cerrar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
        
        <!-- Contenido principal -->
        <!-- Cambiado el padding para que sea más amplio y el margen superior para compensar el navbar -->
        <main class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Sección principal donde se inyecta el contenido de las vistas --}}
            @yield('content')
        </main>
    </div>

    <!-- Script de control para el menú móvil y dropdown (funcionalidad JS) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navToggle = document.getElementById('nav-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const profileMenuButton = document.getElementById('profile-menu-button');
            const profileDropdown = document.getElementById('profile-dropdown');
            
            // 1. Toggle del menú móvil (simula el collapse de Bootstrap)
            if (navToggle) {
                navToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // 2. Toggle del dropdown de perfil
            if (profileMenuButton && profileDropdown) {
                profileMenuButton.addEventListener('click', () => {
                    profileDropdown.classList.toggle('hidden');
                    // Actualiza el estado ARIA
                    profileMenuButton.setAttribute('aria-expanded', profileDropdown.classList.contains('hidden') ? 'false' : 'true');
                });
                
                // Cerrar dropdown al hacer clic fuera
                document.addEventListener('click', (event) => {
                    if (event.target !== profileMenuButton && !profileMenuButton.contains(event.target) && 
                        event.target !== profileDropdown && !profileDropdown.contains(event.target)) {
                        
                        profileDropdown.classList.add('hidden');
                        profileMenuButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>
</body>
</html>