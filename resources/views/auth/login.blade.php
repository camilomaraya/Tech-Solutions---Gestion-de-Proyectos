@extends('layouts.app')

@section('titulo', 'Inicio de sesión')

@section('contenido')
    <h2>Iniciar sesión</h2>

    <div class="tarjeta">
        <form action="{{ route('auth.iniciar') }}" method="POST">
            @csrf

            <div class="campo">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
            </div>

            <div class="campo">
                <label for="clave">Clave</label>
                <input type="password" id="clave" name="clave" required>
            </div>

            <div class="acciones">
                <button type="submit" class="boton">Entrar</button>
                <a href="{{ route('auth.registro') }}" class="boton boton--neutro">Crear cuenta</a>
            </div>
        </form>
    </div>
@endsection
