@extends('layouts.app')

@section('titulo', 'Nuevo proyecto')

@section('contenido')
    <h2>Crear nuevo proyecto</h2>

    <div class="tarjeta">
        <form action="{{ route('proyectos.guardar') }}" method="POST">
            @csrf

            <div class="campo">
                <label for="nombre">Nombre del proyecto</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="campo">
                <label for="fechaInicio">Fecha de inicio</label>
                <input type="date" id="fechaInicio" name="fechaInicio" value="{{ old('fechaInicio') }}" required>
            </div>

            <div class="campo">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="Planificado" @selected(old('estado') === 'Planificado')>Planificado</option>
                    <option value="En progreso" @selected(old('estado') === 'En progreso')>En progreso</option>
                    <option value="Finalizado" @selected(old('estado') === 'Finalizado')>Finalizado</option>
                </select>
            </div>

            <div class="campo">
                <label for="responsable">Responsable</label>
                <input type="text" id="responsable" name="responsable" value="{{ old('responsable') }}" required>
            </div>

            <div class="campo">
                <label for="monto">Monto (CLP)</label>
                <input type="number" id="monto" name="monto" step="1" min="0" value="{{ old('monto') }}" required>
            </div>

            <div class="acciones">
                <button type="submit" class="boton">Guardar proyecto</button>
                <a href="{{ route('proyectos.index') }}" class="boton boton--neutro">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
