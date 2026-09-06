<?php

namespace App\Http\Controllers;

use App\Services\ProyectoServicio;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MostrarProyectoController extends Controller
{
    public function __construct(private ProyectoServicio $proyectoServicio) {}

    public function __invoke(int $id): View
    {
        $proyecto = $this->proyectoServicio->obtenerPorId($id);

        if ($proyecto === null) {
            throw new NotFoundHttpException("No existe el proyecto con id {$id}.");
        }

        return view('proyectos.detalle', ['proyecto' => $proyecto]);
    }
}
