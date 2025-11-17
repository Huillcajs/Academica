@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
{{-- 
    Nota: Este contenido se inyecta en layouts.app. Se asume que layouts.app 
    ya carga Tailwind, los estilos de fuente y las definiciones de color NEON.
--}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

    <!-- Título principal -->
    <h1 class="text-3xl font-display text-neon-cyan mb-8 border-b border-neon-cyan/50 pb-2">
        <i class="fas fa-tachometer-alt mr-2 text-2xl"></i> Panel de Administración
    </h1>

    <!-- Mensaje de Bienvenida -->
    <h1 class="mb-6 text-xl text-gray-300">
        Bienvenido, <span class="text-white font-semibold">{{ Auth::user()->name }}</span> (Administrador)
    </h1>

    <div class="flex flex-wrap -mx-4">
        
        <!-- Tarjeta 1: Total Alumnos (NEON BLUE) -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-6">
            <div class="bg-dark-card text-white rounded-xl shadow-xl border border-neon-blue/30 transition duration-300 hover:shadow-[0_0_25px_rgba(0,191,255,0.7)] p-6">
                <div class="flex flex-col">
                    <h5 class="text-lg font-medium text-neon-blue mb-2">Total Alumnos</h5>
                    <p class="text-5xl font-display font-extrabold mb-4 text-white" style="text-shadow: 0 0 8px #00BFFF;">{{ $totalAlumnos }}</p>
                    <a href="{{ route('alumnos.index') }}" class="flex items-center text-neon-blue text-sm font-semibold opacity-90 hover:opacity-100 transition-opacity">
                        Ver Detalle <i class="fas fa-arrow-circle-right ml-2 text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2: Total Docentes (NEON GREEN) -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-6">
            <div class="bg-dark-card text-white rounded-xl shadow-xl border border-neon-green/30 transition duration-300 hover:shadow-[0_0_25px_rgba(0,255,127,0.7)] p-6">
                <div class="flex flex-col">
                    <h5 class="text-lg font-medium text-neon-green mb-2">Total Docentes</h5>
                    <p class="text-5xl font-display font-extrabold mb-4 text-white" style="text-shadow: 0 0 8px #00FF7F;">{{ $totalDocentes }}</p>
                    <a href="{{ route('docentes.index') }}" class="flex items-center text-neon-green text-sm font-semibold opacity-90 hover:opacity-100 transition-opacity">
                        Ver Detalle <i class="fas fa-arrow-circle-right ml-2 text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3: Cursos Registrados (NEON CYAN) -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-6">
            <div class="bg-dark-card text-white rounded-xl shadow-xl border border-neon-cyan/30 transition duration-300 hover:shadow-[0_0_25px_rgba(0,255,255,0.7)] p-6">
                <div class="flex flex-col">
                    <h5 class="text-lg font-medium text-neon-cyan mb-2">Cursos Registrados</h5>
                    <p class="text-5xl font-display font-extrabold mb-4 text-white" style="text-shadow: 0 0 8px #00FFFF;">{{ $totalCursos }}</p>
                    <a href="{{ route('cursos.index') }}" class="flex items-center text-neon-cyan text-sm font-semibold opacity-90 hover:opacity-100 transition-opacity">
                        Ver Detalle <i class="fas fa-arrow-circle-right ml-2 text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Tarjeta 4: Matrículas Activas (NEON PURPLE) -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-6">
            <div class="bg-dark-card rounded-xl shadow-xl border border-neon-purple/30 transition duration-300 hover:shadow-[0_0_25px_rgba(191,0,255,0.7)] p-6">
                <div class="flex flex-col">
                    <h5 class="text-lg font-medium text-neon-purple mb-2">Matrículas Activas</h5>
                    <p class="text-5xl font-display font-extrabold mb-4 text-white" style="text-shadow: 0 0 8px #BF00FF;">{{ $totalMatriculas }}</p>
                    <a href="{{ route('matriculas.index') }}" class="flex items-center text-neon-purple text-sm font-semibold opacity-90 hover:opacity-100 transition-opacity">
                        Ver Detalle <i class="fas fa-arrow-circle-right ml-2 text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection