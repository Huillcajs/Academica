<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente; // Necesario para asignar el docente al curso
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Mostrar la lista de cursos.
     */
    public function index()
    {
        $cursos = Curso::with('docente.user')->paginate(10); 
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Muestra el formulario para crear un nuevo curso.
     */
    public function create()
    {
        // Se necesita la lista de docentes para el dropdown del formulario
        $docentes = Docente::all(); 
        return view('cursos.create', compact('docentes'));
    }

    /**
     * Almacena un nuevo curso en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255|unique:cursos',
            'creditos' => 'required|integer|min:1|max:20',
            'docente_id' => 'nullable|exists:docentes,id', // Verifica si el docente_id existe en la tabla docentes
            'descripcion' => 'nullable|string',
        ]);

        try {
            // 2. Creación del Curso
            Curso::create([
                'nombre' => $request->nombre,
                'creditos' => $request->creditos,
                'docente_id' => $request->docente_id,
                'descripcion' => $request->descripcion,
            ]);

            return redirect()->route('cursos.index')->with('success', 'El curso "' . $request->nombre . '" fue creado correctamente.');

        } catch (\Exception $e) {
            // Manejo simple de errores (ej. problemas de conexión a DB)
            return redirect()->back()->withInput()->with('error', 'Error al crear el curso: ' . $e->getMessage());
        }
    }

    // Los demás métodos CRUD (show, edit, update, destroy) van aquí.
}