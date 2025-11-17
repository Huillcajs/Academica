@extends('layouts.app')
@section('title', 'Gestión de Matrículas')

@section('content')

<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">

<!-- Encabezado y Botón Nueva Matrícula (Ahora Azul Neón) -->
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 border-b-2 border-neon-blue/50 pb-3">
    <h1 class="text-3xl sm:text-4xl font-display font-bold text-neon-blue mb-4 sm:mb-0" 
        style="text-shadow: 0 0 10px rgba(0, 255, 255, 0.4);">
        <i class="fas fa-address-card mr-3"></i> Matrículas Registradas
    </h1>
    <a href="{{ route('matriculas.create') }}" 
       class="px-6 py-3 text-lg font-bold rounded-xl bg-neon-blue text-dark-bg hover:bg-neon-blue/80 transition duration-300 shadow-lg 
              hover:shadow-[0_0_15px_rgba(0,255,255,0.8)] focus:outline-none focus:ring-4 focus:ring-neon-blue/50">
        <i class="fas fa-file-alt mr-2"></i> Nueva Matrícula
    </a>
</div>

{{-- Notificación de Éxito --}}
@if(session('success'))
    <div class="p-4 mb-6 text-sm font-medium rounded-lg bg-green-900 text-neon-green border border-neon-green/50">
        {{ session('success') }}
    </div>
@endif

<!-- Contenedor de la Tabla -->
<div class="bg-dark-card rounded-xl shadow-2xl overflow-hidden border border-neon-blue/30">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700/50">
            
            <!-- Encabezado de la Tabla -->
            <thead class="bg-gray-800 border-b border-neon-blue">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-blue uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(0, 255, 255, 0.2);">
                        Alumno
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-blue uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(0, 255, 255, 0.2);">
                        Curso
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-blue uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(0, 255, 255, 0.2);">
                        Periodo
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-neon-blue uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(0, 255, 255, 0.2);">
                        Fecha de Matrícula
                    </th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-neon-blue uppercase tracking-wider"
                        style="text-shadow: 0 0 3px rgba(0, 255, 255, 0.2);">
                        Acciones
                    </th>
                </tr>
            </thead>

            <!-- Cuerpo de la Tabla -->
            <tbody class="divide-y divide-gray-700/50 text-gray-300">
                @forelse ($matriculas as $matricula)
                <tr class="hover:bg-gray-800 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neon-blue">
                        {{ $matricula->alumno->user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $matricula->curso->nombre }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-code bg-neon-blue/20 text-neon-blue">
                            {{ $matricula->periodo }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                        {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <div class="flex items-center justify-center space-x-2">
                            {{-- Botón Anular Matrícula (Rojo Neón se mantiene por ser acción peligrosa) --}}
                             {{--<form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('¿Está seguro de que desea anular la matrícula del curso {{ $matricula->curso->nombre }} para el alumno {{ $matricula->alumno->user->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 rounded-full text-white bg-red-700 hover:bg-red-600 transition duration-200" 
                                        title="Anular Matrícula">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>--}}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-lg text-gray-500">
                        <i class="fas fa-exclamation-triangle mr-2 text-neon-blue/50"></i>
                        Módulo de Matrículas: No hay matrículas registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Paginación -->
    @if ($matriculas->lastPage() > 1)
    <div class="px-6 py-4 border-t border-gray-700/50 bg-gray-800/50">
        {{ $matriculas->links('vendor.pagination.tailwind-neon') }} 
    </div>
    @endif
</div>


</div>
@endsection