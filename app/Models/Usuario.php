<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'clave',
    ];

    protected $hidden = [
        'clave',
    ];

    /** Proyectos creados por este usuario */
    public function proyectos(): HasMany
    {
        return $this->hasMany(Proyecto::class, 'created_by');
    }
}
