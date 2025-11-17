@extends('layouts.app')
@section('title', 'Crear Curso')

@section('content')

<div class="max-w-2xl mx-auto p-8 rounded-xl shadow-2xl bg-dark-card border border-neon-green/30">

<!-- Título Principal -->
<h1 class="text-3xl sm:text-4xl font-display font-bold text-neon-green mb-8 border-b-2 border-neon-green/50 pb-2" 
    style="text-shadow: 0 0 10px rgba(57, 255, 20, 0.4);">
    <i class="fas fa-plus-circle mr-3"></i> Crear Nuevo Curso
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

<form action="{{ route('cursos.store') }}" method="POST" class="space-y-6">
    @csrf
    
    {{-- Campo Nombre del Curso --}}
    <div class="space-y-2">
        <label for="nombre" class="block text-sm font-medium text-gray-400">Nombre del Curso</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 
                   focus:ring-neon-green focus:border-neon-green transition duration-300"
            placeholder="Ej: Física Cuántica I">
    </div>

    {{-- Campo Créditos Académicos --}}
    <div class="space-y-2">
        <label for="creditos" class="block text-sm font-medium text-gray-400">Créditos Académicos</label>
        <input type="number" id="creditos" name="creditos" value="{{ old('creditos') }}" min="1" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 
                   focus:ring-neon-green focus:border-neon-green transition duration-300"
            placeholder="Ej: 4">
    </div>

    {{-- Campo Docente a Cargo (Select) --}}
    <div class="space-y-2">
        <label for="docente_id" class="block text-sm font-medium text-gray-400">Docente a Cargo</label>
        <select id="docente_id" name="docente_id"
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 
                   focus:ring-neon-green focus:border-neon-green transition duration-300 appearance-none">
            <option value="" class="bg-gray-700 text-gray-300">-- Seleccionar Docente (Opcional) --</option>
            @foreach ($docentes as $docente)
                <option value="{{ $docente->id }}" class="bg-gray-700 text-gray-200" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                    {{ $docente->user->name }} ({{ $docente->especialidad }})
                </option>
            @endforeach
        </select>
    </div>

    {{-- Campo Descripción --}}
    <div class="space-y-2">
        <label for="descripcion" class="block text-sm font-medium text-gray-400">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="3"
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 
                   focus:ring-neon-green focus:border-neon-green transition duration-300"
            placeholder="Breve descripción del contenido del curso...">{{ old('descripcion') }}</textarea>
    </div>

    {{-- Botones de Acción --}}
    <div class="flex space-x-4 pt-4">
        <button type="submit" 
            class="flex-1 px-6 py-3 text-lg font-bold rounded-xl bg-neon-green text-dark-bg hover:bg-neon-green/80 transition duration-300 shadow-lg 
                   hover:shadow-[0_0_15px_rgba(57,255,20,0.8)] focus:outline-none focus:ring-4 focus:ring-neon-green/50">
            <i class="fas fa-save mr-2"></i> Guardar Curso
        </button>
        <a href="{{ route('cursos.index') }}" 
            class="flex-1 text-center px-6 py-3 text-lg font-bold rounded-xl bg-gray-700 text-gray-200 hover:bg-gray-600 transition duration-300 shadow-lg 
                   hover:shadow-[0_0_10px_rgba(100,100,100,0.5)] focus:outline-none focus:ring-4 focus:ring-gray-500/50">
            <i class="fas fa-times-circle mr-2"></i> Cancelar
        </a>
    </div>
</form>


</div>
@endsection