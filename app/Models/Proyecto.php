<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'fechaInicio',
        'estado',
        'responsable',
        'monto',
        'created_by',
    ];

    protected $casts = [
        'fechaInicio' => 'date',
        'monto' => 'decimal:2',
    ];

    /** El usuario que creó el proyecto */
    public function creador(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'created_by');
    }
}
