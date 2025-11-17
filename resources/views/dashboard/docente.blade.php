@extends('layouts.app')
@section('title', 'Panel de Docente')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">¡Hola, Profesor(a) {{ Auth::user()->name }}!</h1>
    <h5 class="text-muted mb-4">Panel de Asignaciones y Cursos</h5>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book-reader me-2"></i> Cursos Asignados</h5>
                    <p class="card-text fs-2">{{ $cursosAsignados }}</p>
                    <p class="card-text">Total de materias bajo su cargo.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-dark bg-light shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-list-alt me-2"></i> Lista de Cursos</h5>
                    <p class="card-text">Acceda a la información detallada de sus cursos.</p>
                    <a href="{{ route('cursos.index') }}" class="btn btn-sm btn-outline-primary">Ver Cursos</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-dark bg-light shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-graduate me-2"></i> Alumnos Registrados</h5>
                    <p class="card-text">Consulte el listado general de estudiantes.</p>
                    <a href="{{ route('alumnos.index') }}" class="btn btn-sm btn-outline-success">Ver Alumnos</a>
                </div>
            </div>
        </div>

    </div>
    
    <hr>
    
    <p class="mt-4 text-muted">Utilice el menú superior para acceder a la gestión de datos permitida según su rol.</p>

</div>
@endsection