<?php

use App\Http\Controllers\Api\ProyectoApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('proyectos', ProyectoApiController::class);
