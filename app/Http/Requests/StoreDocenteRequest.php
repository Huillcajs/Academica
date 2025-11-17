<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDocenteRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        // 2. REEMPLAZAR 'auth()->' con 'Auth::'
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * Obtiene las reglas de validación que se aplican a la petición.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'codigo' => 'required|string|unique:docentes',
            'especialidad' => 'required|string|max:255',
        ];
    }
}