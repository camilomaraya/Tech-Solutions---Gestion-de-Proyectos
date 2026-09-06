<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ActualizarProyectoRequest;
use App\Http\Requests\Api\GuardarProyectoRequest;
use App\Models\Proyecto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProyectoApiController extends Controller
{
    /** GET /api/proyectos — lista todos los proyectos */
    public function index(): JsonResponse
    {
        return response()->json(Proyecto::all(), 200);
    }

    /** POST /api/proyectos — crea un proyecto */
    public function store(GuardarProyectoRequest $request): JsonResponse
    {
        $proyecto = Proyecto::create($request->validated());

        return response()->json($proyecto, 201);
    }

    /** GET /api/proyectos/{id} — busca un proyecto por su ID */
    public function show(string $id): JsonResponse
    {
        $proyecto = Proyecto::findOrFail($id);

        return response()->json($proyecto, 200);
    }

    /** PUT|PATCH /api/proyectos/{id} — actualiza un proyecto */
    public function update(ActualizarProyectoRequest $request, string $id): JsonResponse
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($request->validated());

        return response()->json($proyecto->fresh(), 201);
    }

    /** DELETE /api/proyectos/{id} — elimina un proyecto */
    public function destroy(string $id): Response
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return response()->noContent();
    }
}
