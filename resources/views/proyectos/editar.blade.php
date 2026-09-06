@extends('layouts.app')

@section('titulo', 'Editar proyecto')

@section('contenido')
    <h2>Editar proyecto #{{ $proyecto->id }}</h2>

    <div class="tarjeta">
        <form action="{{ route('proyectos.actualizar', $proyecto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="campo">
                <label for="nombre">Nombre del proyecto</label>
                <input type="text" id="nombre" name="nombre"
                       value="{{ old('nombre', $proyecto->nombre) }}" required>
            </div>

            <div class="campo">
                <label for="fechaInicio">Fecha de inicio</label>
                <input type="date" id="fechaInicio" name="fechaInicio"
                       value="{{ old('fechaInicio', $proyecto->fechaInicio) }}" required>
            </div>

            <div class="campo">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    @foreach (['Planificado', 'En progreso', 'Finalizado'] as $estado)
                        <option value="{{ $estado }}" @selected(old('estado', $proyecto->estado) === $estado)>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="campo">
                <label for="responsable">Responsable</label>
                <input type="text" id="responsable" name="responsable"
                       value="{{ old('responsable', $proyecto->responsable) }}" required>
            </div>

            <div class="campo">
                <label for="monto">Monto (CLP)</label>
                <input type="number" id="monto" name="monto" step="1" min="0"
                       value="{{ old('monto', $proyecto->monto) }}" required>
            </div>

            <div class="acciones">
                <button type="submit" class="boton">Actualizar proyecto</button>
                <a href="{{ route('proyectos.detalle', $proyecto->id) }}" class="boton boton--neutro">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
