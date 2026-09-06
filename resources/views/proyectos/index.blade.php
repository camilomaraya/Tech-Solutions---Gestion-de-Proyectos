@extends('layouts.app')

@section('titulo', 'Listado de proyectos')

@section('contenido')
    <h2>Listado de proyectos</h2>

    <p class="acciones" style="margin-bottom:16px">
        <a class="boton" href="{{ route('proyectos.crear') }}">+ Nuevo proyecto</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha inicio</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($proyecto->fechaInicio)->format('d/m/Y') }}</td>
                    <td>{{ $proyecto->estado }}</td>
                    <td>{{ $proyecto->responsable }}</td>
                    <td>${{ number_format($proyecto->monto, 0, ',', '.') }}</td>
                    <td class="acciones">
                        <a class="boton" href="{{ route('proyectos.detalle', $proyecto->id) }}">Ver</a>
                        <a class="boton boton--neutro" href="{{ route('proyectos.editar', $proyecto->id) }}">Editar</a>
                        <a class="boton boton--peligro" href="{{ route('proyectos.confirmar-eliminar', $proyecto->id) }}">Eliminar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay proyectos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
