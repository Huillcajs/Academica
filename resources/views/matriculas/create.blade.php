@extends('layouts.app')
@section('title', 'Nueva Matrícula')

@section('content')

<div class="max-w-2xl mx-auto p-8 rounded-xl shadow-2xl bg-dark-card border border-neon-blue/30">

<!-- Título Principal -->
<h1 class="text-3xl sm:text-4xl font-display font-bold text-neon-blue mb-8 border-b-2 border-neon-blue/50 pb-2" 
    style="text-shadow: 0 0 10px rgba(0, 255, 255, 0.4);">
    <i class="fas fa-file-alt mr-3"></i> Registrar Nueva Matrícula
</h1>

{{-- Manejo de Errores (Añadido para consistencia) --}}
@if ($errors->any())
    <div class="p-4 mb-4 text-sm font-medium rounded-lg bg-red-900 text-red-300 border border-red-700/50">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('matriculas.store') }}" method="POST" class="space-y-6">
    @csrf
    
    {{-- Campo Seleccionar Alumno --}}
    <div class="space-y-2">
        <label for="alumno_id" class="block text-sm font-medium text-gray-400">Seleccionar Alumno</label>
        <select id="alumno_id" name="alumno_id" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 
                   focus:ring-neon-blue focus:border-neon-blue transition duration-300 appearance-none">
            <option value="" class="bg-gray-700 text-gray-300">-- Seleccionar Alumno --</option>
            @foreach ($alumnos as $alumno)
                <option value="{{ $alumno->id }}" class="bg-gray-700 text-gray-200" {{ old('alumno_id') == $alumno->id ? 'selected' : '' }}>
                    {{ $alumno->user->name }} (Cód: {{ $alumno->codigo }})
                </option>
            @endforeach
        </select>
    </div>

    {{-- Campo Seleccionar Curso --}}
    <div class="space-y-2">
        <label for="curso_id" class="block text-sm font-medium text-gray-400">Seleccionar Curso</label>
        <select id="curso_id" name="curso_id" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 
                   focus:ring-neon-blue focus:border-neon-blue transition duration-300 appearance-none">
            <option value="" class="bg-gray-700 text-gray-300">-- Seleccionar Curso --</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}" class="bg-gray-700 text-gray-200" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                    {{ $curso->nombre }} ({{ $curso->creditos }} Créditos)
                </option>
            @endforeach
        </select>
    </div>
    
    {{-- Campo Periodo Académico --}}
    <div class="space-y-2">
        <label for="periodo" class="block text-sm font-medium text-gray-400">Periodo Académico (Ej: 2025-I)</label>
        <input type="text" id="periodo" name="periodo" value="{{ old('periodo', now()->year . '-I') }}" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 
                   focus:ring-neon-blue focus:border-neon-blue transition duration-300"
            placeholder="Ej: 2025-I">
    </div>
    
    {{-- Campo Fecha de Matrícula --}}
    <div class="space-y-2">
        <label for="fecha_matricula" class="block text-sm font-medium text-gray-400">Fecha de Matrícula</label>
        <input type="date" id="fecha_matricula" name="fecha_matricula" value="{{ old('fecha_matricula', date('Y-m-d')) }}" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 
                   focus:ring-neon-blue focus:border-neon-blue transition duration-300">
    </div>

    {{-- Botones de Acción --}}
    <div class="flex space-x-4 pt-4">
        <button type="submit" 
            class="flex-1 px-6 py-3 text-lg font-bold rounded-xl bg-neon-blue text-dark-bg hover:bg-neon-blue/80 transition duration-300 shadow-lg 
                   hover:shadow-[0_0_15px_rgba(0,255,255,0.8)] focus:outline-none focus:ring-4 focus:ring-neon-blue/50">
            <i class="fas fa-save mr-2"></i> Registrar Matrícula
        </button>
        <a href="{{ route('matriculas.index') }}" 
            class="flex-1 text-center px-6 py-3 text-lg font-bold rounded-xl bg-gray-700 text-gray-200 hover:bg-gray-600 transition duration-300 shadow-lg 
                   hover:shadow-[0_0_10px_rgba(100,100,100,0.5)] focus:outline-none focus:ring-4 focus:ring-gray-500/50">
            <i class="fas fa-times-circle mr-2"></i> Cancelar
        </a>
    </div>
</form>


</div>
@endsection