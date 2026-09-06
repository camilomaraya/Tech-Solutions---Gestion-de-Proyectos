<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Gestión de Proyectos') | Tech Solutions</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: system-ui, Arial, sans-serif;
            background: #f4f6f8; color: #1f2933; line-height: 1.5;
        }
        .contenedor { max-width: 960px; margin: 0 auto; padding: 24px 16px; }
        .cabecera {
            background: #1b3a5c; color: #fff; padding: 16px 0;
        }
        .cabecera__interior {
            max-width: 960px; margin: 0 auto; padding: 0 16px;
            display: flex; justify-content: space-between;
            align-items: center; flex-wrap: wrap; gap: 12px;
        }
        .cabecera__titulo { font-size: 20px; }
        .cabecera__titulo a { color: #fff; text-decoration: none; }
        h2 { margin-bottom: 16px; font-size: 22px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #e1e5ea; text-align: left; }
        th { background: #e8edf2; font-size: 14px; }
        .boton {
            display: inline-block; padding: 8px 14px; border: none;
            border-radius: 4px; background: #1b3a5c; color: #fff;
            text-decoration: none; font-size: 14px; cursor: pointer;
        }
        .boton--peligro { background: #b3261e; }
        .boton--neutro { background: #6b7684; }
        .acciones { display: flex; gap: 8px; flex-wrap: wrap; }
        .tarjeta {
            background: #fff; border: 1px solid #e1e5ea;
            border-radius: 6px; padding: 20px; margin-bottom: 20px;
        }
        .campo { margin-bottom: 14px; }
        .campo label { display: block; font-weight: 600; margin-bottom: 4px; font-size: 14px; }
        .campo input, .campo select {
            width: 100%; padding: 8px; border: 1px solid #c3cad2; border-radius: 4px;
        }
        .alerta {
            background: #e6f4ea; border-left: 4px solid #2e7d32;
            padding: 12px; margin-bottom: 16px; border-radius: 4px;
        }
        .alerta--error { background: #fdecea; border-left-color: #b3261e; }
        .tarjeta-uf {
            background: #fff; border: 1px solid #d7dde4; border-radius: 6px;
            padding: 10px 14px; text-align: right; min-width: 190px;
        }
        .tarjeta-uf__titulo { display: block; font-size: 12px; color: #5a6672; }
        .tarjeta-uf__valor { display: block; font-size: 20px; color: #1b3a5c; }
        .tarjeta-uf__origen { font-size: 11px; color: #78838f; }
        dl { display: grid; grid-template-columns: 190px 1fr; gap: 8px 16px; }
        dt { font-weight: 600; }
    </style>
</head>
<body>
    <header class="cabecera">
        <div class="cabecera__interior">
            <h1 class="cabecera__titulo">
                <a href="{{ route('proyectos.index') }}">Tech Solutions · Gestión de Proyectos</a>
            </h1>
                <div class="cabecera__interior" style="gap:12px; padding:0; max-width:none;">
            @if (session('usuario_id'))
                <span style="font-size:13px;">{{ session('usuario_nombre') }}</span>
                <form action="{{ route('auth.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="boton boton--neutro">Salir</button>
                </form>
            @else
                <a href="{{ route('auth.login') }}" class="boton boton--neutro">Iniciar sesión</a>
            @endif
            <x-valor-uf />
        </div>
        </div>
    </header>

    <main class="contenedor">
        @if (session('mensaje'))
            <div class="alerta">{{ session('mensaje') }}</div>
        @endif

        @if ($errors->any())
            <div class="alerta alerta--error">
                <strong>Revisa los siguientes campos:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('contenido')
    </main>
</body>
</html>
