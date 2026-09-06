<?php

namespace App\Http\Controllers;

use App\Services\ProyectoServicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ActualizarProyectoController extends Controller
{
    public function __construct(private ProyectoServicio $proyectoServicio) {}

    public function formulario(int $id): View
    {
        $proyecto = $this->proyectoServicio->obtenerPorId($id);

        if ($proyecto === null) {
            throw new NotFoundHttpException("No existe el proyecto con id {$id}.");
        }

        return view('proyectos.editar', ['proyecto' => $proyecto]);
    }

    public function actualizar(Request $request, int $id): RedirectResponse
    {
        $datos = $request->validate([
            'nombre'      => ['required', 'string', 'max:120'],
            'fechaInicio' => ['required', 'date'],
            'estado'      => ['required', 'in:Planificado,En progreso,Finalizado'],
            'responsable' => ['required', 'string', 'max:120'],
            'monto'       => ['required', 'numeric', 'min:0'],
        ]);

        $proyecto = $this->proyectoServicio->actualizar($id, $datos);

        if ($proyecto === null) {
            throw new NotFoundHttpException("No existe el proyecto con id {$id}.");
        }

        return redirect()
            ->route('proyectos.detalle', $id)
            ->with('mensaje', "Proyecto \"{$proyecto->nombre}\" actualizado correctamente.");
    }
}
