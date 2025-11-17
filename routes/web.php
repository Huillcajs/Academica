<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
Route::post('/logout', [SocialiteController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- GESTIÓN DE LECTURA Y ESCRITURA (Docente y Admin) ---
    // Este grupo es el más amplio para Docentes y Administradores.
    Route::middleware('role:admin,docente')->group(function () {
        
        // ALUMNOS: Se excluye 'show' para evitar el error de método no definido.
        // La restricción de permisos de escritura se hace en AlumnoController::__construct.
        Route::resource('alumnos', AlumnoController::class)->except(['show']);

        // DOCENTES: Se asume que DocenteController sí tiene todos los métodos.
        Route::resource('docentes', DocenteController::class);

        // CURSOS: Se excluye 'show' para evitar el error.
        Route::resource('cursos', CursoController::class)->except(['show']);
    });


    // --- GESTIÓN DE MATRÍCULAS (Admin y Alumno) ---
    Route::middleware('role:admin,alumno')->group(function () {
        Route::resource('matriculas', MatriculaController::class)->only(['index', 'create', 'store']);
    });
});
