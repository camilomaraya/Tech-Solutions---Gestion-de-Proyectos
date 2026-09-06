<?php

namespace App\Http\Controllers;

use App\Services\ProyectoServicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EliminarProyectoController extends Controller
{
    public function __construct(private ProyectoServicio $proyectoServicio) {}

    public function confirmar(int $id): View
    {
        $proyecto = $this->proyectoServicio->obtenerPorId($id);

        if ($proyecto === null) {
            throw new NotFoundHttpException("No existe el proyecto con id {$id}.");
        }

        return view('proyectos.eliminar', ['proyecto' => $proyecto]);
    }

    public function eliminar(int $id): RedirectResponse
    {
        if (! $this->proyectoServicio->eliminar($id)) {
            throw new NotFoundHttpException("No existe el proyecto con id {$id}.");
        }

        return redirect()
            ->route('proyectos.index')
            ->with('mensaje', 'Proyecto eliminado correctamente.');
    }
}
