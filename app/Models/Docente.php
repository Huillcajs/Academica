<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'codigo',
        'especialidad',
    ];

    /**
     * Un docente pertenece a un usuario.
     */
    
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function cursos(): HasMany {
        return $this->hasMany(Curso::class);
    }
}