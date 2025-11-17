<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matricula extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'alumno_id',
        'curso_id',
        'periodo',
        'fecha_matricula',
    ];
    
    /**
     * Una matrícula pertenece a un alumno.
     */
    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class);
    }
    
    /**
     * Una matrícula pertenece a un curso.
     */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }
}