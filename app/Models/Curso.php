<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'creditos',
        'docente_id', // Foreign key para el docente
        'descripcion',
    ];

    /**
     * Un curso pertenece a un docente.
     */
    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class);
    }

    /**
     * Un curso tiene muchas matrículas.
     */
    public function matriculas(): HasMany
    {
        // Relación 1:N (la tabla 'matriculas' tiene la FK curso_id)
        return $this->hasMany(Matricula::class);
    }
}