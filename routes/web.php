<?php

use App\Http\Controllers\ActualizarProyectoController;
use App\Http\Controllers\CrearProyectoController;
use App\Http\Controllers\EliminarProyectoController;
use App\Http\Controllers\ListarProyectosController;
use App\Http\Controllers\MostrarProyectoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::redirect('/', '/proyectos');

// 1. Listar todos los proyectos
Route::get('/proyectos', ListarProyectosController::class)
    ->name('proyectos.index');

// 2. Agregar proyecto
Route::get('/proyectos/crear', [CrearProyectoController::class, 'formulario'])
    ->name('proyectos.crear');
Route::post('/proyectos', [CrearProyectoController::class, 'guardar'])
    ->name('proyectos.guardar');

// 5. Obtener un proyecto por su id
Route::get('/proyectos/{id}', MostrarProyectoController::class)
    ->whereNumber('id')->name('proyectos.detalle');

// 4. Actualizar proyecto por su id
Route::get('/proyectos/{id}/editar', [ActualizarProyectoController::class, 'formulario'])
    ->whereNumber('id')->name('proyectos.editar');
Route::put('/proyectos/{id}', [ActualizarProyectoController::class, 'actualizar'])
    ->whereNumber('id')->name('proyectos.actualizar');

// 3. Eliminar proyecto por su Id
Route::get('/proyectos/{id}/eliminar', [EliminarProyectoController::class, 'confirmar'])
    ->whereNumber('id')->name('proyectos.confirmar-eliminar');
Route::delete('/proyectos/{id}', [EliminarProyectoController::class, 'eliminar'])
    ->whereNumber('id')->name('proyectos.eliminar');

// Registro de Usuario
Route::get('/registro', [AuthController::class, 'formularioRegistro'])
    ->name('auth.registro');
Route::post('/registro', [AuthController::class, 'registrar'])
    ->name('auth.registrar');

// Inicio de Sesión de Usuario
Route::get('/login', [AuthController::class, 'formularioLogin'])
    ->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('auth.iniciar');

// Cierre de sesión
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');
