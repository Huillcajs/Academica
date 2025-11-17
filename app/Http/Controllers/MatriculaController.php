<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatriculaController extends Controller
{
    /**
     * Muestra el listado de matrículas.
     */
    public function index()
    {
        $matriculas = Matricula::with(['alumno.user', 'curso'])->paginate(10);
        return view('matriculas.index', compact('matriculas'));
    }

    /**
     * Muestra el formulario para crear una nueva matrícula.
     */
    public function create()
    {
        // Se necesita la lista de alumnos y cursos para el formulario
        $alumnos = Alumno::with('user')->get();
        $cursos = Curso::all();
        return view('matriculas.create', compact('alumnos', 'cursos'));
    }

    /**
     * Almacena una nueva matrícula.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => [
                'required',
                'exists:cursos,id',
                // Regla de unicidad compleja: 
                // La combinación de alumno_id y curso_id debe ser única dentro del mismo 'periodo'
                Rule::unique('matriculas')->where(function ($query) use ($request) {
                    return $query->where('alumno_id', $request->alumno_id)
                                 ->where('curso_id', $request->curso_id)
                                 ->where('periodo', $request->periodo);
                }),
            ],
            'periodo' => 'required|string|max:10', // Ej: 2025-I
            'fecha_matricula' => 'required|date',
        ]);

        try {
            // 2. Creación de la Matrícula
            Matricula::create($request->all());

            return redirect()->route('matriculas.index')->with('success', 'Matrícula registrada con éxito.');

        } catch (\Exception $e) {
            // Manejo de errores (ej. problemas de conexión)
            return redirect()->back()->withInput()->with('error', 'Error al registrar la matrícula: ' . $e->getMessage());
        }
    }

    // Los demás métodos CRUD van aquí.
}