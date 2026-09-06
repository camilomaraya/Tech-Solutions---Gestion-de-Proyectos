<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /** Muestra el formulario de registro */
    public function formularioRegistro(): View
    {
        return view('auth.registro');
    }

    /** Crea el usuario cifrando la clave antes de almacenarla */
    public function registrar(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'correo' => ['required', 'email', 'max:150', 'unique:usuarios,correo'],
            'clave'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Usuario::create([
            'nombre' => $datos['nombre'],
            'correo' => $datos['correo'],
            'clave'  => Hash::make($datos['clave']),
        ]);

        return redirect()
            ->route('auth.login')
            ->with('mensaje', 'Cuenta creada correctamente. Ya puedes iniciar sesión.');
    }

    /** Muestra el formulario de inicio de sesión */
    public function formularioLogin(): View
    {
        return view('auth.login');
    }

    /** Valida las credenciales contra el hash almacenado */
    public function login(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'correo' => ['required', 'email'],
            'clave'  => ['required', 'string'],
        ]);

        $usuario = Usuario::where('correo', $datos['correo'])->first();

        if ($usuario === null || ! Hash::check($datos['clave'], $usuario->clave)) {
            return back()
                ->withInput($request->only('correo'))
                ->withErrors(['correo' => 'Las credenciales ingresadas no son válidas.']);
        }

        $request->session()->regenerate();
        $request->session()->put('usuario_id', $usuario->id);
        $request->session()->put('usuario_nombre', $usuario->nombre);

        return redirect()
            ->route('proyectos.index')
            ->with('mensaje', "Bienvenido, {$usuario->nombre}.");
    }

    /** Cierra la sesión */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('auth.login');
    }
}
