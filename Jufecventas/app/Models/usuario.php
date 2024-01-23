<?php

// app/Models/Usuario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'usuario', 'contrasena', 'tipo_usuario',
    ];

    protected $hidden = [
        'contrasena',
    ];

    // Puedes agregar más relaciones, métodos y propiedades aquí según tus necesidades
}
