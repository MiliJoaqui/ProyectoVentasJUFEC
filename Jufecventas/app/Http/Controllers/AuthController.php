<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Método para procesar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => 'required',
            'contrasena' => 'required',
        ]);

        // Modificamos el intento de inicio de sesión para tener en cuenta el tipo de usuario
        if (Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    }

    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Método para obtener la ruta de redirección después del inicio de sesión
    protected function redirectPath()
    {
        $user = Auth::user();

        // Cambiamos la comprobación de tipo de usuario
        if ($user->tipo_usuario === 'vendedor') {
            return '/vendedor';
        } elseif ($user->tipo_usuario === 'gerente') {
            return '/gerente';
        } else {
            return '/home';
        }
    }
}
