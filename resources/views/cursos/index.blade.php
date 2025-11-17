@extends('layouts.app')
@section('title', 'Gestión de Cursos')

@section('content')

<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">

<!-- Encabezado y Botón Nuevo Curso -->
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 border-b-2 border-neon-green/50 pb-3">
    <h1 class="text-3xl sm:text-4xl font-display font-bold text-neon-green mb-4 sm:mb-0" 
        style="text-shadow: 0 0 10px rgba(57, 255, 20, 0.4);">
        <i class="fas fa-book mr-3"></i> Cursos Ofrecidos
    </h1>
    <a href="{{ route('cursos.create') }}" 
       class="px-6 py-3 text-lg font-bold rounded-xl bg-neon-green text-dark-bg hover:bg-neon-green/80 transition duration-300 shadow-lg 
              hover:shadow-[0_0_15px_rgba(57,255,20,0.8)] focus:outline-none focus:ring-4 focus:ring-neon-green/50">
        <i class="fas fa-plus mr-2"></i> Crear Nuevo Curso
    </a>
</div>

{{-- Notificación de Éxito --}}
@if(session('success'))
    <div class="p-4 mb-6 text-sm font-medium rounded-lg bg-green-900 text-neon-green border border-neon-green/50">
        {{ session('success') }}
    </div>
@endif

<!-- Contenedor de la Tabla -->
<div class="bg-dark-card rounded-xl shadow-2xl overflow-hidden border border-neon-green/30">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700/50">
            
            <!-- Encabezado de la Tabla -->
            <thead class="bg-gray-800 border-b border-neon-green">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-green uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(57, 255, 20, 0.2);">
                        Nombre del Curso
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-green uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(57, 255, 20, 0.2);">
                        Créditos
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-green uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(57, 255, 20, 0.2);">
                        Docente a Cargo
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-green uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(57, 255, 20, 0.2);">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-neon-green uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(57, 255, 20, 0.2);">
                        Acciones
                    </th>
                </tr>
            </thead>

            <!-- Cuerpo de la Tabla -->
            <tbody class="divide-y divide-gray-700/50 text-gray-300">
                @forelse ($cursos as $curso)
                <tr class="hover:bg-gray-800 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neon-blue">
                        {{ $curso->nombre }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-code bg-neon-green/20 text-neon-green">
                            {{ $curso->creditos }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $curso->docente ? $curso->docente->user->name : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-400 max-w-xs truncate">
                        {{ Str::limit($curso->descripcion, 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <div class="flex items-center justify-center space-x-2">
                            {{-- Botón Editar (Warning -> Amarillo Neón) --}}
                            <a href="{{ route('cursos.edit', $curso->id) }}" 
                               class="p-2 rounded-full text-dark-bg bg-neon-yellow hover:bg-neon-yellow/80 transition duration-200" 
                               title="Editar">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            
                            {{-- Botón Eliminar (Danger -> Rojo Neón) --}}
                            <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('¿Está seguro de que desea eliminar el curso {{ $curso->nombre }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 rounded-full text-white bg-red-700 hover:bg-red-600 transition duration-200" 
                                        title="Eliminar">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-lg text-gray-500">
                        <i class="fas fa-exclamation-triangle mr-2 text-neon-green/50"></i>
                        Módulo de Cursos: No hay cursos registrados en la base de datos.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginación -->
    @if ($cursos->lastPage() > 1)
    <div class="px-6 py-4 border-t border-gray-700/50 bg-gray-800/50">
        {{ $cursos->links('vendor.pagination.tailwind-neon') }} 
    </div>
    @endif
</div>


</div>
@endsection