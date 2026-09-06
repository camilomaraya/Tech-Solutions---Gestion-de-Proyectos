@extends('layouts.app')

@section('titulo', 'Detalle del proyecto')

@section('contenido')
    <h2>Proyecto #{{ $proyecto->id }}</h2>

    <div class="tarjeta">
        <dl>
            <dt>Nombre</dt>
            <dd>{{ $proyecto->nombre }}</dd>

            <dt>Fecha de inicio</dt>
            <dd>{{ \Carbon\Carbon::parse($proyecto->fechaInicio)->format('d/m/Y') }}</dd>

            <dt>Estado</dt>
            <dd>{{ $proyecto->estado }}</dd>

            <dt>Responsable</dt>
            <dd>{{ $proyecto->responsable }}</dd>

            <dt>Monto</dt>
            <dd>${{ number_format($proyecto->monto, 0, ',', '.') }}</dd>
        </dl>
    </div>

    <div class="acciones">
        <a href="{{ route('proyectos.editar', $proyecto->id) }}" class="boton">Editar</a>
        <a href="{{ route('proyectos.confirmar-eliminar', $proyecto->id) }}" class="boton boton--peligro">Eliminar</a>
        <a href="{{ route('proyectos.index') }}" class="boton boton--neutro">Volver al listado</a>
    </div>
@endsection
