@extends('layouts.app')

@section('titulo', 'Registro de usuario')

@section('contenido')
    <h2>Crear cuenta</h2>

    <div class="tarjeta">
        <form action="{{ route('auth.registrar') }}" method="POST">
            @csrf

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="campo">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
            </div>

            <div class="campo">
                <label for="clave">Clave</label>
                <input type="password" id="clave" name="clave" minlength="8" required>
            </div>

            <div class="campo">
                <label for="clave_confirmation">Repetir clave</label>
                <input type="password" id="clave_confirmation" name="clave_confirmation" minlength="8" required>
            </div>

            <div class="acciones">
                <button type="submit" class="boton">Registrarme</button>
                <a href="{{ route('auth.login') }}" class="boton boton--neutro">Ya tengo cuenta</a>
            </div>
        </form>
    </div>
@endsection
