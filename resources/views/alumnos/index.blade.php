@extends('layouts.app')
@section('title', 'Listado de Alumnos')

@section('content')
{{-- Definición de colores customizados si el layout principal no los incluye --}}
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'dark-bg': '#101419',
                    'dark-card': '#1a1c22',
                    'neon-blue': '#00BFFF',
                    'neon-green': '#00FF7F',
                    'neon-yellow': '#FFFF00',
                },
                fontFamily: {
                    display: ['Orbitron', 'sans-serif'],
                },
            }
        }
    }
</script>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    
    {{-- Encabezado y Botón de Crear --}}
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-neon-blue/50">
        <h1 class="text-3xl font-display font-bold text-neon-blue tracking-wider">
            <i class="fas fa-user-graduate mr-3 text-2xl"></i> Módulo de Alumnos
        </h1>
        
        {{-- Botón Create (NEON GREEN) --}}
        <a href="{{ route('alumnos.create') }}" 
           class="bg-neon-green text-dark-card font-bold py-2 px-4 rounded-lg transition duration-300 shadow-lg shadow-neon-green/30 hover:bg-neon-green/80 hover:shadow-xl hover:shadow-neon-green/50 transform hover:scale-[1.02]">
            <i class="fas fa-plus mr-2"></i> Registrar Nuevo Alumno
        </a>
    </div>

    {{-- Mensajes de Sesión (Alertas estilo Neón) --}}
    @if (session('success'))
        <div class="bg-dark-card text-neon-green border border-neon-green/70 rounded-lg p-4 mb-6 shadow-lg shadow-neon-green/20">
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-dark-card text-red-500 border border-red-500/70 rounded-lg p-4 mb-6 shadow-lg shadow-red-500/20">
            <p class="font-semibold">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Tabla de Alumnos --}}
    <div class="bg-dark-card rounded-xl shadow-2xl overflow-x-auto border border-gray-700/50">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-[#1e2329]">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neon-blue uppercase tracking-wider">
                        Código
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neon-blue uppercase tracking-wider">
                        Nombre Completo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neon-blue uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neon-blue uppercase tracking-wider">
                        Fecha Nacimiento
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neon-blue uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($alumnos as $alumno)
                    <tr class="hover:bg-[#252830] transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-neon-yellow/90">
                            #{{ $alumno->codigo }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">
                            {{ $alumno->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            {{ $alumno->user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            {{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- Enlace de edición (NEON YELLOW) --}}
                            <a href="{{ route('alumnos.edit', $alumno->id) }}" 
                               class="bg-neon-yellow text-dark-card font-semibold py-1 px-3 rounded-full text-xs shadow-md shadow-neon-yellow/30 hover:shadow-lg hover:shadow-neon-yellow/50 transition duration-300">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                            {{-- Aquí iría el formulario de eliminación (ej: botón rojo neón) --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-lg text-gray-500 italic">
                            No se encontraron datos en el sistema.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="flex justify-center mt-8 text-gray-400">
        {{ $alumnos->links() }}
    </div>
</div>
@endsection