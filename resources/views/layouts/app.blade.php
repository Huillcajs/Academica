<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIG-Académico | @yield('title', 'Inicio')</title>

    <!-- Carga de Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FUENTES: Inter (general) y Orbitron (para títulos y números, estilo Sci-Fi) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Orbitron:wght[400;700;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome (Íconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJc5f85U1uJ6W9aA/w4gB5w+8w7kYm6T9N/m1jYvC+A3nNn/d3l+B4gXg8fQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Definiciones de Variables CSS para el Tema Dark/Neon */
        :root {
            --dark-bg: #0d0e13; 
            --dark-surface: #1a1c22; 
            --sidebar-bg: #11131a; 
            --nav-text: #f8ff; 

            /* Colores Neón */
            --neon-blue: #00BFFF; 
            --neon-green: #39FF14; 
            --neon-cyan: #00FFFF; 
            --neon-purple: #C800FF; 
            --neon-text: var(--neon-cyan); 
        }

        /* Estilos base */
        body {
            background-color: var(--dark-bg);
            color: var(--nav-text); 
            font-family: 'Inter', sans-serif;
            overflow-x: hidden; 
        }
        
        /* Contenedor principal para Desktop/Sidebar */
        #dashboard-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Base (Solo visible en pantallas medianas o más grandes) */
        .sidebar {
            width: 16rem; /* Ancho default de escritorio */
            background-color: var(--sidebar-bg);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            transition: width 0.3s ease-in-out;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 50;
            display: none; /* Oculto por defecto, visible con md:block */
        }
        
        /* Solo aplica estilos de sidebar colapsable en Desktop */
        @media (min-width: 768px) {
            .sidebar { display: flex; flex-direction: column; }
            .sidebar.collapsed { width: 5rem; }
            .sidebar.collapsed .link-text, .sidebar.collapsed .nav-profile-info { display: none; }

            /* Contenido Principal (Maneja el desplazamiento para Desktop) */
            .main-content {
                margin-left: 16rem; 
                width: calc(100% - 16rem);
                transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
                flex-grow: 1;
            }
            .sidebar.collapsed ~ .main-content {
                margin-left: 5rem;
                width: calc(100% - 5rem);
            }
        }
        
        /* Estilos de Enlace Sidebar (compartidos) */
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            font-weight: 500;
            color: var(--nav-text);
            transition: all 0.2s ease-in-out;
            text-decoration: none; /* Asegura que no haya subrayado en móvil/escritorio */
        }

        .sidebar-link:hover, .sidebar-link.active {
            background-color: var(--dark-surface);
            color: var(--neon-cyan); 
            box-shadow: inset 3px 0 0 var(--neon-cyan), 0 0 5px rgba(0, 255, 255, 0.2);
        }

        /* Estilos Navbar Móvil (visible solo en pantallas pequeñas) */
        .custom-navbar-mobile {
            background-color: var(--sidebar-bg);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .navbar-brand {
            font-family: 'Orbitron', sans-serif; 
            color: white; 
            font-size: 1.25rem;
        }
        .mobile-nav-item {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
        }
        .mobile-nav-item:hover {
            background-color: #2c2f35;
        }
    </style>

    <!-- Configuración de Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': 'var(--dark-bg)',
                        'dark-card': 'var(--dark-surface)',
                        'sidebar-bg': 'var(--sidebar-bg)',
                        'neon-blue': 'var(--neon-blue)',
                        'neon-green': 'var(--neon-green)',
                        'neon-cyan': 'var(--neon-cyan)',
                        'neon-purple': 'var(--neon-purple)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Orbitron', 'sans-serif'], 
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-dark-bg text-gray-100">
    
    @auth
    
    {{-- =============================================== --}}
    {{-- 1. NAVBAR SUPERIOR (SOLO EN MÓVIL) --}}
    {{-- =============================================== --}}
    <nav class="custom-navbar-mobile md:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand y Toggle -->
                <div class="flex items-center">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <i class="fas fa-graduation-cap mr-2 text-neon-cyan"></i> SIG-Académico
                    </a>
                </div>
                
                <!-- Botón Toggler para móvil -->
                <div>
                    <button id="mobile-nav-toggle" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menú principal</span>
                        <i id="mobile-icon" class="fas fa-bars h-6 w-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menú Móvil (inicialmente oculto) -->
        <div class="hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-white border-t border-gray-700">
                
                <a href="{{ route('dashboard') }}" class="mobile-nav-item hover:bg-neon-cyan/20">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                
                {{-- ENLACES ADMINISTRADOR --}}
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('alumnos.index') }}" class="mobile-nav-item hover:bg-neon-cyan/20">
                        <i class="fas fa-user-graduate mr-3"></i> Alumnos
                    </a>
                    <a href="{{ route('docentes.index') }}" class="mobile-nav-item hover:bg-neon-green/20">
                        <i class="fas fa-chalkboard-teacher mr-3"></i> Docentes
                    </a>
                    <a href="{{ route('cursos.index') }}" class="mobile-nav-item hover:bg-neon-blue/20">
                        <i class="fas fa-book mr-3"></i> Cursos
                    </a>
                @endif

                {{-- ENLACES DOCENTE --}}
                @if (Auth::user()->role === 'docente')
                    <a href="{{ route('alumnos.index') }}" class="mobile-nav-item hover:bg-neon-cyan/20">
                        <i class="fas fa-user-graduate mr-3"></i> Alumnos
                    </a>
                    <a href="{{ route('cursos.index') }}" class="mobile-nav-item hover:bg-neon-blue/20">
                        <i class="fas fa-book mr-3"></i> Mis Cursos
                    </a>
                @endif

                {{-- ENLACES DE MATRÍCULAS (Admin y Alumno) --}}
                @if (in_array(Auth::user()->role, ['admin', 'alumno']))
                    <a href="{{ route('matriculas.index') }}" class="mobile-nav-item hover:bg-neon-purple/20">
                        <i class="fas fa-address-book mr-3"></i> Matrículas
                    </a>
                @endif

                {{-- Logout en móvil --}}
                <a href="#" class="mobile-nav-item text-red-400 hover:bg-red-900/20 mt-2 border-t border-gray-700 pt-2"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-3"></i> {{ Auth::user()->name }} | Cerrar Sesión
                </a>
                
                {{-- Formulario de Logout (oculto) --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    
    {{-- =============================================== --}}
    {{-- 2. CONTENEDOR PRINCIPAL (Desktop Sidebar) --}}
    {{-- =============================================== --}}
    <div id="dashboard-layout">
        
        <!-- BARRA LATERAL (SIDEBAR) - OCULTO EN MÓVIL (md:hidden está en el CSS base) -->
        <aside id="sidebar" class="sidebar">
            <div class="p-4 flex items-center justify-between h-16 border-b border-gray-700/50">
                <a class="navbar-brand nav-link font-display text-xl tracking-wider" href="{{ url('/') }}">
                    <i class="fas fa-graduation-cap mr-2 text-neon-cyan"></i> SIG-Académico
                </a>
                
                {{-- Botón para Colapsar/Expandir (Solo visible en Desktop) --}}
                <button id="sidebar-toggle" type="button" class="text-gray-400 hover:text-white focus:outline-none transition duration-150 ease-in-out">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </div>

            <!-- Menú de Navegación del Sidebar -->
            <div class="flex-grow p-2 space-y-1">
                
                <a href="{{ route('dashboard') }}" class="sidebar-link active" data-color="neon-cyan">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="link-text ml-3">Dashboard</span>
                </a>

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('alumnos.index') }}" class="sidebar-link" data-color="neon-cyan">
                        <i class="fas fa-user-graduate w-6"></i>
                        <span class="link-text ml-3">Alumnos</span>
                    </a>
                    <a href="{{ route('docentes.index') }}" class="sidebar-link" data-color="neon-green">
                        <i class="fas fa-chalkboard-teacher w-6"></i>
                        <span class="link-text ml-3">Docentes</span>
                    </a>
                    <a href="{{ route('cursos.index') }}" class="sidebar-link" data-color="neon-blue">
                        <i class="fas fa-book w-6"></i>
                        <span class="link-text ml-3">Cursos</span>
                    </a>
                @endif

                @if (Auth::user()->role === 'docente')
                    <a href="{{ route('alumnos.index') }}" class="sidebar-link" data-color="neon-cyan">
                        <i class="fas fa-user-graduate w-6"></i>
                        <span class="link-text ml-3">Alumnos</span>
                    </a>
                    <a href="{{ route('cursos.index') }}" class="sidebar-link" data-color="neon-blue">
                        <i class="fas fa-book w-6"></i>
                        <span class="link-text ml-3">Mis Cursos</span>
                    </a>
                @endif

                @if (in_array(Auth::user()->role, ['admin', 'alumno']))
                    <a href="{{ route('matriculas.index') }}" class="sidebar-link" data-color="neon-purple">
                        <i class="fas fa-address-book w-6"></i>
                        <span class="link-text ml-3">Matrículas</span>
                    </a>
                @endif
            </div>

            <!-- Sección Inferior (Perfil y Logout) -->
            <div class="mt-auto p-4 border-t border-gray-700/50">
                <div class="flex items-center justify-start nav-profile-info mb-2">
                    <i class="fas fa-user-circle text-2xl text-neon-cyan"></i>
                    <div class="ml-3">
                        <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-400">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                </div>
                
                <a href="#" class="sidebar-link text-red-500 hover:bg-red-900/20" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="link-text ml-3">Cerrar Sesión</span>
                </a>
            </div>
        </aside>

        <!-- CONTENIDO PRINCIPAL (Incluye espacio para la barra lateral en Desktop) -->
        <div id="main-content" class="main-content">
            
            {{-- Barra superior con información simple (Solo visible en Desktop) --}}
            <header class="hidden md:flex h-16 items-center justify-end px-4 border-b border-gray-800 bg-dark-bg sticky top-0 z-40">
                <div class="text-gray-400 text-sm">
                    Bienvenido, {{ Auth::user()->name }}
                </div>
            </header>
            
            <main class="py-6 px-4 md:px-8">
                @yield('content')
            </main>
        </div>
    </div>
    @endauth

    <!-- Script de control para el menú móvil y la barra lateral de escritorio -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mobileNavToggle = document.getElementById('mobile-nav-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileIcon = document.getElementById('mobile-icon');
            
            // ===================================
            // Lógica de Sidebar (Solo Desktop)
            // ===================================
            if (sidebar && sidebarToggle && window.innerWidth >= 768) {
                let isCollapsed = false;
                const desktopToggleIcon = sidebarToggle.querySelector('i');

                sidebarToggle.addEventListener('click', () => {
                    isCollapsed = !isCollapsed;
                    sidebar.classList.toggle('collapsed', isCollapsed);

                    // Cambiar el icono (Flecha izquierda para expandido, flecha derecha para colapsado)
                    if (desktopToggleIcon) {
                        desktopToggleIcon.classList.toggle('fa-arrow-left');
                        desktopToggleIcon.classList.toggle('fa-arrow-right'); 
                    }
                });
                
                // Inicializar en estado expandido y con icono de colapso
                sidebar.classList.remove('collapsed');
                if (desktopToggleIcon) {
                    desktopToggleIcon.classList.add('fa-arrow-left');
                    desktopToggleIcon.classList.remove('fa-arrow-right');
                }
            }


            // ===================================
            // Lógica de Navbar Móvil (Solo Mobile)
            // ===================================
            if (mobileNavToggle && mobileMenu) {
                mobileNavToggle.addEventListener('click', () => {
                    const isHidden = mobileMenu.classList.toggle('hidden');
                    
                    // Cambiar icono de hamburguesa a X (cerrar)
                    if (mobileIcon) {
                        mobileIcon.classList.toggle('fa-bars', isHidden);
                        mobileIcon.classList.toggle('fa-times', !isHidden);
                    }
                });
            }

            // ===================================
            // Lógica de Estilos Neón (Compartida)
            // ===================================
            const applyNeonStyles = () => {
                // Selecciona enlaces de ambos, sidebar y mobile menu
                const links = document.querySelectorAll('.sidebar-link, .mobile-nav-item');
                const currentPath = window.location.pathname; 

                links.forEach(link => {
                    const linkUrl = link.getAttribute('href');
                    const neonColorVar = link.getAttribute('data-color');
                    
                    // Determinar si el enlace está activo
                    const isActive = linkUrl && (currentPath === linkUrl || (linkUrl !== '/' && currentPath.startsWith(linkUrl)));
                    
                    if (isActive) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }

                    // Aplicar la variable CSS para el color de acento solo si existe data-color (solo sidebar)
                    if (neonColorVar && window.innerWidth >= 768) {
                        const neonColor = getComputedStyle(document.documentElement).getPropertyValue(`--${neonColorVar}`);
                        
                        if (link.classList.contains('active')) {
                            link.style.setProperty('color', neonColor, 'important');
                            link.style.setProperty('box-shadow', `inset 3px 0 0 ${neonColor}, 0 0 8px ${neonColor}30`, 'important');
                        } else {
                            link.style.removeProperty('color');
                            link.style.removeProperty('box-shadow');
                        }

                        // Aplicar el color de hover dinámicamente
                        link.onmouseover = () => {
                            link.style.setProperty('color', neonColor, 'important');
                        };
                        link.onmouseout = () => {
                            if (!link.classList.contains('active')) {
                                link.style.removeProperty('color');
                            }
                        };
                    }
                });
            };

            // Inicializar estilos y reajustar en resize si es necesario
            applyNeonStyles();
            window.addEventListener('resize', applyNeonStyles);
        });
    </script>
</body>
</html>