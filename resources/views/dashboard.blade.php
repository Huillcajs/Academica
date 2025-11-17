@extends('layouts.app') 
@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard Académico Central</h1>
    <p class="lead">Resumen y KPIs para la toma de decisiones.</p>
    <hr>
    
    <div class="row">
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-user-graduate"></i> Total Alumnos</h5>
                        <h2 class="display-4">{{ $totalAlumnos }}</h2>
                    </div>
                    <a href="{{ route('alumnos.index') }}" class="text-white mt-3">Gestionar &raquo;</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Total Docentes</h5>
                        <h2 class="display-4">{{ $totalDocentes }}</h2>
                    </div>
                    <a href="#" class="text-white mt-3">Gestionar &raquo;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info h-100 shadow">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-book"></i> Cursos Activos</h5>
                        <h2 class="display-4">{{ $totalCursos }}</h2>
                    </div>
                    <a href="#" class="text-white mt-3">Gestionar &raquo;</a>
                </div>
            </div>
        </div>
        
        <div class="col-12 mt-4">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white"><i class="fas fa-chart-bar me-2"></i>Reportes para la Toma de Decisiones</div>
                <div class="card-body">
                    <p>Aquí se integrarían **gráficos de matrículas por periodo** o **distribución de calificaciones** generados con librerías JavaScript ligeras (ej. Chart.js).</p>
                    <button class="btn btn-outline-secondary">Generar Reporte Detallado</button>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection