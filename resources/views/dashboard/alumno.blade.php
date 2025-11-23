@extends('layouts.app')
@section('title', 'Panel de Estudiante')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Bienvenido, Estudiante {{ Auth::user()->name }}</h1>
    <h5 class="text-muted mb-4">Tu Resumen Académico</h5>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-check me-2"></i> Matrículas Activas</h5>
                    <p class="card-text fs-2">{{ $misMatriculas }}</p>
                    <p class="card-text">Total de cursos en los que estás inscrito.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-dark bg-light shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-id-card me-2"></i> Código Universitario</h5>
                    @php
                        // Nota: Para mostrar datos específicos del alumno (como el código),
                        // la lógica del DashboardController debe cargar el modelo Alumno asociado
                        // al usuario autenticado.
                        $alumno = \App\Models\Alumno::where('user_id', Auth::id())->first();
                    @endphp
                    @if ($alumno)
                        <p class="card-text fs-2 text-primary">{{ $alumno->codigo }}</p>
                    @else
                        <p class="card-text fs-2 text-danger">N/A</p>@extends('layouts.app')
@section('title', 'Panel de Estudiante')

@section('content')

{{-- Define colores customizados si no están en el layout principal --}}

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
'neon-red': '#FF4500', // Un color neón para alertas o métricas
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
<h1 class="text-3xl sm:text-5xl font-display font-bold text-neon-yellow mb-2"
    style="text-shadow: 0 0 15px rgba(255, 255, 0, 0.6);">
    Bienvenido, Estudiante <span class="text-neon-cyan">{{ Auth::user()->name }}</span>
</h1>
<h5 class="text-lg text-gray-400 mb-8 border-b border-gray-700 pb-3">Tu Resumen Académico y Accesos Rápidos</h5>

{{-- Manejo de Alertas --}}
@if (session('error'))
    <div class="p-4 mb-6 text-sm font-medium rounded-lg bg-red-900 text-neon-red border border-red-700/50 shadow-lg">
        <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="p-4 mb-6 text-sm font-medium rounded-lg bg-green-900 text-neon-green border border-green-700/50 shadow-lg">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- CARD 1: Matrículas Activas (Métrica) -->
    <div class="bg-dark-card p-6 rounded-xl shadow-2xl border border-neon-yellow/50 transform hover:scale-[1.02] transition duration-300 cursor-default"
         style="box-shadow: 0 0 20px rgba(255, 255, 0, 0.3);">
        <div class="flex flex-col h-full">
            <h5 class="text-xl font-semibold text-neon-yellow mb-3">
                <i class="fas fa-calendar-check mr-2"></i> Matrículas Activas
            </h5>
            <p class="text-6xl font-bold text-white mb-2 tracking-wider">{{ $misMatriculas }}</p>
            <p class="text-gray-400 mt-auto">Total de cursos en los que estás inscrito actualmente.</p>
        </div>
    </div>

    <!-- CARD 2: Código Universitario (Identificador) -->
    <div class="bg-dark-card p-6 rounded-xl shadow-xl border border-neon-cyan/30 transform hover:scale-[1.02] transition duration-300">
        <div class="flex flex-col h-full justify-between">
            <h5 class="text-xl font-semibold text-neon-cyan mb-3">
                <i class="fas fa-id-card mr-2"></i> Código Universitario
            </h5>
            
            @php
                // Nota: Para fines de la vista, mantenemos la consulta aquí, 
                // aunque idealmente esta lógica debería estar en el DashboardController
                $alumno = \App\Models\Alumno::where('user_id', Auth::id())->first();
            @endphp
            
            @if ($alumno)
                <p class="text-5xl font-mono text-neon-blue mb-2 break-all" style="text-shadow: 0 0 5px rgba(0, 191, 255, 0.5);">
                    {{ $alumno->codigo }}
                </p>
                <p class="text-gray-400 mt-auto">Tu identificador único de estudiante.</p>
            @else
                <p class="text-4xl font-bold text-neon-red mb-2">error
                <p class="text-gray-400 mt-auto">No se encontró el perfil de alumno asociado.</p>
            @endif
        </div>
    </div>

    <!-- CARD 3: Registrar Matrícula (Acción) -->
    <div class="bg-dark-card p-6 rounded-xl shadow-xl border border-neon-green/30 transform hover:scale-[1.02] transition duration-300">
        <div class="flex flex-col h-full justify-between">
            <h5 class="text-xl font-semibold text-neon-green mb-3">
                <i class="fas fa-file-alt mr-2"></i> Registrar Matrícula
            </h5>
            <p class="text-gray-300">Inscríbete en un nuevo curso para el próximo ciclo académico.</p>
            <a href="{{ route('matriculas.create') }}" 
               class="mt-4 w-full text-center px-4 py-2 font-bold rounded-lg bg-neon-green text-dark-card hover:bg-neon-green/80 transition duration-300 shadow-md
                      hover:shadow-[0_0_10px_rgba(0,255,127,0.7)]">
                <i class="fas fa-plus-circle mr-2"></i> Matricularme Ahora
            </a>
        </div>
    </div>

</div>

<div class="mt-8 pt-4 border-t border-gray-700/50">
    <p class="text-gray-500 text-sm italic">
        <i class="fas fa-info-circle mr-2"></i> Para ver el detalle de tus cursos, utiliza el menú superior "Matrículas".
    </p>
</div>


</div>
@endsection
                    @endif
                    <p class="card-text">Tu identificador único en el sistema.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-dark bg-light shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-file-alt me-2"></i> Registrar Matrícula</h5>
                    <p class="card-text">Inscríbete en un nuevo curso académico.</p>
                    <a href="{{ route('matriculas.create') }}" class="btn btn-sm btn-outline-warning">Matricularme</a>
                </div>
            </div>
        </div>

    </div>
    
    <hr>
    
    <p class="mt-4 text-muted">Utiliza el menú superior "Matrículas" para ver o registrar tus asignaturas.</p>

</div>
@endsection