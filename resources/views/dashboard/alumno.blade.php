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
                        <p class="card-text fs-2 text-danger">N/A</p>
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