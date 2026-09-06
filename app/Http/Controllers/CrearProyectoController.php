<?php

namespace App\Http\Controllers;

use App\Services\ProyectoServicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CrearProyectoController extends Controller
{
    public function __construct(private ProyectoServicio $proyectoServicio) {}

    public function formulario(): View
    {
        return view('proyectos.crear');
    }

    public function guardar(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre'      => ['required', 'string', 'max:120'],
            'fechaInicio' => ['required', 'date'],
            'estado'      => ['required', 'in:Planificado,En progreso,Finalizado'],
            'responsable' => ['required', 'string', 'max:120'],
            'monto'       => ['required', 'numeric', 'min:0'],
        ]);

        $datos['created_by'] = session('usuario_id');

        $proyecto = $this->proyectoServicio->crear($datos);

        return redirect()
            ->route('proyectos.index')
            ->with('mensaje', "Proyecto \"{$proyecto->nombre}\" creado correctamente.");
    }
}
