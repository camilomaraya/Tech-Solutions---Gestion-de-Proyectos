@extends('layouts.app')

@section('titulo', 'Eliminar proyecto')

@section('contenido')
    <h2>Eliminar proyecto #{{ $proyecto->id }}</h2>

    <div class="tarjeta">
        <p style="margin-bottom:16px">
            ¿Confirmas la eliminación del proyecto
            <strong>{{ $proyecto->nombre }}</strong>?
            Esta acción no se puede deshacer.
        </p>

        <dl>
            <dt>Responsable</dt>
            <dd>{{ $proyecto->responsable }}</dd>

            <dt>Estado</dt>
            <dd>{{ $proyecto->estado }}</dd>

            <dt>Monto</dt>
            <dd>${{ number_format($proyecto->monto, 0, ',', '.') }}</dd>
        </dl>
    </div>

    <form action="{{ route('proyectos.eliminar', $proyecto->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="acciones">
            <button type="submit" class="boton boton--peligro">Sí, eliminar</button>
            <a href="{{ route('proyectos.index') }}" class="boton boton--neutro">Cancelar</a>
        </div>
    </form>
@endsection
