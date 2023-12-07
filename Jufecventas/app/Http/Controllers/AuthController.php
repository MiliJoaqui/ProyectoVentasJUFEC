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
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()->withErrors(['email' => 'Credenciales incorrectas']);
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
        if (Auth::user()->role === 'vendedor') {
            return '/vendedor';
        } elseif (Auth::user()->role === 'gerente') {
            return '/gerencia';
        } else {
            return '/home';
        }
    }
}
