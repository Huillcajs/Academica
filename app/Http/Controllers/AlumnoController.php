<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Añadir para la contraseña

class AlumnoController extends Controller
{

    /**
     * Muestra una lista de todos los alumnos (Accesible por Admin y Docente).
     */
    public function index()
    {
        $alumnos = Alumno::with('user')->paginate(10); 
        return view('alumnos.index', compact('alumnos')); 
    }

    /**
     * Muestra el formulario para crear un nuevo alumno (Solo Admin).
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Almacena un nuevo alumno (y su usuario asociado) en la base de datos (Solo Admin).
     */
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Añadir validación de contraseña
            'codigo' => 'required|string|unique:alumnos',
            'fecha_nacimiento' => 'required|date',
        ]);

        try {
            DB::beginTransaction(); 
            
            // 1. Crea el registro de usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Encriptar la contraseña
                'role' => 'alumno', 
            ]);
            
            // 2. Crea el registro de alumno asociado
            Alumno::create([
                'user_id' => $user->id,
                'codigo' => $request->codigo,
                'fecha_nacimiento' => $request->fecha_nacimiento,
            ]);
            
            DB::commit(); 
            
            return redirect()->route('alumnos.index')->with('success', 'Alumno registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->withInput()->with('error', 'Error al registrar el alumno: ' . $e->getMessage());
        }
    }
    
    /**
     * Muestra el formulario para editar el alumno (Solo Admin).
     */
    public function edit(Alumno $alumno)
    {
        // El user asociado se carga automáticamente gracias a la relación
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        // NOTA: Se usa el AlumnoModel inyectado automáticamente. 
        // Su user asociado se accede vía $alumno->user

        // 1. Validación de datos
        $request->validate([
            // La validación del email debe ignorar el email actual del usuario que estamos editando
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $alumno->user_id,
            // La validación del código debe ignorar el código actual del alumno que estamos editando
            'codigo' => 'required|string|unique:alumnos,codigo,' . $alumno->id,
            'fecha_nacimiento' => 'required|date',
            // Opcional: Si se envía una contraseña, validarla
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

        try {
            DB::beginTransaction(); 

            // 2. Actualizar el registro de Usuario
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            // Si se proporcionó una nueva contraseña, actualizarla
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $alumno->user->update($userData);
            
            // 3. Actualizar el registro de Alumno
            $alumno->update([
                'codigo' => $request->codigo,
                'fecha_nacimiento' => $request->fecha_nacimiento,
            ]);
            
            DB::commit(); 
            
            return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack(); 
            // Manejo de error
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el alumno: ' . $e->getMessage());
        }
    }

    // Los métodos update y destroy deben ser implementados aquí si son necesarios
}