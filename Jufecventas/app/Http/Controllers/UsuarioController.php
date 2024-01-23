<?php

// app/Http/Controllers/UsuarioController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        // Validación de campos
        $request->validate([
            'usuario' => 'required|unique:usuarios',
            'contrasena' => 'required',
            'tipo_usuario' => 'required|in:gerente,vendedor',
        ]);

        // Crear un nuevo usuario
        Usuario::create([
            'usuario' => $request->usuario,
            'contrasena' => bcrypt($request->contrasena),
            'tipo_usuario' => $request->tipo_usuario,
        ]);

        return redirect()->route('crear-usuario.create')->with('success', 'Usuario creado exitosamente.');
    }
}

