<?php

namespace App\Http\Controllers;

use App\Services\ProyectoServicio;
use Illuminate\View\View;

class ListarProyectosController extends Controller
{
    public function __construct(private ProyectoServicio $proyectoServicio) {}

    public function __invoke(): View
    {
        return view('proyectos.index', [
            'proyectos' => $this->proyectoServicio->obtenerTodos(),
        ]);
    }
}
