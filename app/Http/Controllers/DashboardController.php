<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = []; 
        $view = '';

        if ($user->role === 'admin') {
            $data['totalAlumnos'] = Alumno::count();
            $data['totalDocentes'] = Docente::count();
            $data['totalCursos'] = Curso::count();
            $data['totalMatriculas'] = Matricula::count();
            $view = 'dashboard.admin';

        } elseif ($user->role === 'docente') {
            $docente = Docente::where('user_id', $user->id)->first();
            $data['cursosAsignados'] = $docente ? $docente->cursos()->count() : 0;
            $view = 'dashboard.docente';

        } elseif ($user->role === 'alumno') {
            $alumno = Alumno::where('user_id', $user->id)->first();
            $data['misMatriculas'] = $alumno ? $alumno->matriculas()->count() : 0;
            $view = 'dashboard.alumno'; 
        } else {
            return redirect('/');
        }

        return view($view, $data);
    }
}