<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocenteRequest;
use App\Models\Docente;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Mostrar la lista de docentes.
     */
    public function index()
    {
        // Se asume que Docente tiene una relación con User para obtener el nombre/email
        $docentes = Docente::with('user')->paginate(10); 
        return view('docentes.index', compact('docentes'));
    }

    /**
     * Muestra el formulario para crear un nuevo docente.
     */
    public function create()
    {
        return view('docentes.create');
    }

    /**
     * Almacena un nuevo docente en la base de datos.
     */
    public function store(StoreDocenteRequest $request)
    {
        // La validación se hace automáticamente antes de llegar aquí.
        try {
            DB::beginTransaction(); 

            // Crear el Usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'docente', 
            ]);

            // Crear el Docente
            Docente::create([
                'user_id' => $user->id,
                'codigo' => $request->codigo,
                'especialidad' => $request->especialidad,
            ]);

            DB::commit(); 

            return redirect()->route('docentes.index')->with('success', 'Docente ' . $request->name . ' registrado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->withInput()->with('error', 'Error al registrar el docente.');
        }
    }
    // Los métodos show, edit, update y destroy se implementarán según el requerimiento CRUD completo.

    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }

    // Nuevo método para actualizar los datos
    public function update(Request $request, Docente $docente)
    {
        // TODO: Usar UpdateDocenteRequest para validación avanzada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $docente->user_id, // Excluir email del usuario actual
            'especialidad' => 'required|string|max:255',
        ]);
        
        try {
            DB::beginTransaction();

            // 1. Actualizar Usuario
            $docente->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // 2. Actualizar Docente
            $docente->update([
                'especialidad' => $request->especialidad,
            ]);
            
            DB::commit();
            
            return redirect()->route('docentes.index')->with('success', 'Docente actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el docente.');
        }
    }

    // Nuevo método para eliminar el Docente
    public function destroy(Docente $docente)
    {
        try {
            DB::beginTransaction();
            
            $docenteName = $docente->user->name;
            $docente->user->delete(); // Eliminar el Usuario (esto debe eliminar al Docente por FK CASCADE)
            
            DB::commit();
            
            return redirect()->route('docentes.index')->with('success', 'Docente ' . $docenteName . ' eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar el docente: ' . $e->getMessage());
        }
    }

}