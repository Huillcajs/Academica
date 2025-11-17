@extends('layouts.app')
@section('title', 'Registrar Docente')

@section('content')

<div class="max-w-xl mx-auto p-8 rounded-xl shadow-2xl bg-dark-card border border-neon-purple/30">

<!-- Título Principal -->
<h1 class="text-3xl sm:text-4xl font-display font-bold text-neon-purple mb-8 border-b-2 border-neon-purple/50 pb-2" 
    style="text-shadow: 0 0 10px rgba(200, 0, 255, 0.4);">
    <i class="fas fa-user-plus mr-3"></i> Registrar Nuevo Docente
</h1>

{{-- Manejo de Errores (Si estuvieran presentes, aunque no se incluyeron en el original) --}}
@if ($errors->any())
    <div class="p-4 mb-4 text-sm font-medium rounded-lg bg-red-900 text-red-300 border border-red-700/50">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('docentes.store') }}" method="POST" class="space-y-6">
    @csrf
    
    {{-- Datos de Usuario --}}
    <h2 class="text-xl font-semibold text-neon-cyan mt-6 mb-4 border-b border-gray-600 pb-1"
         style="text-shadow: 0 0 5px rgba(0, 255, 255, 0.3);">
        Datos de Acceso
    </h2>
    
    {{-- Campo Nombre Completo --}}
    <div class="space-y-2">
        <label for="name" class="block text-sm font-medium text-gray-400">Nombre Completo</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 focus:ring-neon-purple focus:border-neon-purple transition duration-300"
            placeholder="Ej: Jane Smith">
    </div>

    {{-- Campo Email Institucional --}}
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-400">Email Institucional</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 focus:ring-neon-purple focus:border-neon-purple transition duration-300"
            placeholder="docente@sig-academico.edu">
    </div>
    
    {{-- Campo Contraseña (Añadido por defecto para la creación de usuario) --}}
    <div class="space-y-2">
        <label for="password" class="block text-sm font-medium text-gray-400">Contraseña (Temporal)</label>
        <input type="password" id="password" name="password" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 focus:ring-neon-purple focus:border-neon-purple transition duration-300"
            placeholder="Mínimo 8 caracteres">
    </div>

    {{-- Datos del Docente --}}
    <h2 class="text-xl font-semibold text-neon-cyan mt-8 mb-4 border-b border-gray-600 pb-1"
         style="text-shadow: 0 0 5px rgba(0, 255, 255, 0.3);">
        Datos del Docente
    </h2>

    {{-- Campo Código Docente --}}
    <div class="space-y-2">
        <label for="codigo" class="block text-sm font-medium text-gray-400">Código Docente</label>
        <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 focus:ring-neon-purple focus:border-neon-purple transition duration-300"
            placeholder="Ej: D2024001">
    </div>

    {{-- Campo Especialidad/Área --}}
    <div class="space-y-2">
        <label for="especialidad" class="block text-sm font-medium text-gray-400">Especialidad/Área</label>
        <input type="text" id="especialidad" name="especialidad" value="{{ old('especialidad') }}" required
            class="w-full px-4 py-3 bg-dark-bg border border-gray-700/50 rounded-lg text-gray-200 placeholder-gray-500 focus:ring-neon-purple focus:border-neon-purple transition duration-300"
            placeholder="Ej: Programación Avanzada, Matemáticas, Historia">
    </div>

    {{-- Botones de Acción --}}
    <div class="flex space-x-4 pt-4">
        <button type="submit" 
            class="flex-1 px-6 py-3 text-lg font-bold rounded-xl bg-neon-purple text-dark-bg hover:bg-neon-purple/80 transition duration-300 shadow-lg 
                   hover:shadow-[0_0_15px_rgba(200,0,255,0.8)] focus:outline-none focus:ring-4 focus:ring-neon-purple/50">
            <i class="fas fa-save mr-2"></i> Guardar Docente
        </button>
        <a href="{{ route('docentes.index') }}" 
            class="flex-1 text-center px-6 py-3 text-lg font-bold rounded-xl bg-gray-700 text-gray-200 hover:bg-gray-600 transition duration-300 shadow-lg 
                   hover:shadow-[0_0_10px_rgba(100,100,100,0.5)] focus:outline-none focus:ring-4 focus:ring-gray-500/50">
            <i class="fas fa-times-circle mr-2"></i> Cancelar
        </a>
    </div>
</form>


</div>
@endsection