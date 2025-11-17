<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Importar
use Illuminate\Database\Eloquent\Relations\HasMany;   // <-- Importar

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'codigo',
        'fecha_nacimiento',
    ];

    /**
     * Un alumno pertenece a un usuario.
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    
    public function matriculas(): HasMany {
        return $this->hasMany(Matricula::class);
    }
}