<?php

namespace App\Services;

use App\Models\Proyecto;

class ProyectoServicio
{
    public function obtenerTodos(): array
    {
        return Proyecto::orderBy('id')->get()->all();
    }

    public function obtenerPorId(int $id): ?Proyecto
    {
        return Proyecto::find($id);
    }

    public function crear(array $datos): Proyecto
    {
        return Proyecto::create($datos);
    }

    public function actualizar(int $id, array $datos): ?Proyecto
    {
        $proyecto = Proyecto::find($id);

        if ($proyecto === null) {
            return null;
        }

        $proyecto->update($datos);

        return $proyecto;
    }

    public function eliminar(int $id): bool
    {
        $proyecto = Proyecto::find($id);

        return $proyecto !== null && $proyecto->delete();
    }
}
