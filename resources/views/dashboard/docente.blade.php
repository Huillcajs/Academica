@extends('layouts.app')
@section('title', 'Panel de Docente')

@section('content')

{{-- Definición de colores customizados (Asegúrate de que 'neon-cyan' y otros estén definidos en tu layout principal si eliminas este script) --}}

<script>
tailwind.config = {
theme: {
extend: {
colors: {
'dark-bg': '#101419',
'dark-card': '#1a1c22',
'neon-blue': '#00BFFF',
'neon-cyan': '#00FFFF',
'neon-green': '#00FF7F',
'neon-yellow': '#FFFF00',
'neon-purple': '#A020F0',
},
fontFamily: {
display: ['Orbitron', 'sans-serif'],
},
}
}
}
</script>

<div class="max-w-7xl mx-auto p-4 sm:p-8 text-gray-200">

<!-- Título Principal -->
<h1 class="text-3xl sm:text-5xl font-display font-bold text-neon-cyan mb-2"
    style="text-shadow: 0 0 15px rgba(0, 255, 255, 0.6);">
    ¡Hola, Profesor(a) <span class="text-neon-yellow">{{ Auth::user()->name }}</span>!
</h1>
<h5 class="text-lg text-gray-400 mb-8 border-b border-gray-700 pb-3">Panel de Asignaciones y Cursos</h5>

{{-- Manejo de Errores/Alertas --}}
@if (session('error'))
    <div class="p-4 mb-6 text-sm font-medium rounded-lg bg-red-900 text-red-300 border border-red-700/50 shadow-lg">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="p-4 mb-6 text-sm font-medium rounded-lg bg-green-900 text-neon-green border border-green-700/50 shadow-lg">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- CARD 1: Cursos Asignados (Métrica Principal) -->
    <div class="bg-dark-card p-6 rounded-xl shadow-2xl border border-neon-blue/50 transform hover:scale-[1.02] transition duration-300 cursor-default"
         style="box-shadow: 0 0 20px rgba(0, 191, 255, 0.3);">
        <div class="flex flex-col h-full">
            <h5 class="text-xl font-semibold text-neon-blue mb-3">
                <i class="fas fa-book-reader me-2"></i> Cursos Asignados
            </h5>
            <p class="text-6xl font-bold text-white mb-2 tracking-wider">{{ $cursosAsignados }}</p>
            <p class="text-gray-400 mt-auto">Total de materias bajo su cargo este período.</p>
        </div>
    </div>

    <!-- CARD 2: Lista de Cursos (Acción) -->
    <div class="bg-dark-card p-6 rounded-xl shadow-xl border border-neon-cyan/30 transform hover:scale-[1.02] transition duration-300">
        <div class="flex flex-col h-full justify-between">
            <h5 class="text-xl font-semibold text-neon-cyan mb-3">
                <i class="fas fa-list-alt me-2"></i> Gestión de Cursos
            </h5>
            <p class="text-gray-300">Acceda y administre la información detallada de los cursos que imparte.</p>
            <a href="{{ route('cursos.index') }}" 
               class="mt-4 w-full text-center px-4 py-2 font-bold rounded-lg bg-neon-cyan text-dark-card hover:bg-neon-cyan/80 transition duration-300 shadow-md 
                      hover:shadow-[0_0_10px_rgba(0,255,255,0.7)]">
                <i class="fas fa-arrow-right mr-2"></i> Ver Mis Cursos
            </a>
        </div>
    </div>

    <!-- CARD 3: Alumnos Registrados (Acción) -->
    <div class="bg-dark-card p-6 rounded-xl shadow-xl border border-neon-green/30 transform hover:scale-[1.02] transition duration-300">
        <div class="flex flex-col h-full justify-between">
            <h5 class="text-xl font-semibold text-neon-green mb-3">
                <i class="fas fa-user-graduate me-2"></i> Gestión de Alumnos
            </h5>
            <p class="text-gray-300">Consulte el listado general de estudiantes para gestión administrativa.</p>
            <a href="{{ route('alumnos.index') }}" 
               class="mt-4 w-full text-center px-4 py-2 font-bold rounded-lg bg-neon-green text-dark-card hover:bg-neon-green/80 transition duration-300 shadow-md
                      hover:shadow-[0_0_10px_rgba(0,255,127,0.7)]">
                <i class="fas fa-arrow-right mr-2"></i> Ver Alumnos
            </a>
        </div>
    </div>

</div>

<div class="mt-8 pt-4 border-t border-gray-700/50">
    <p class="text-gray-500 text-sm italic">
        <i class="fas fa-info-circle mr-2"></i> Utilice la barra de navegación o los accesos directos de arriba para gestionar la información permitida según su rol de docente.
    </p>
</div>


</div>
@endsection