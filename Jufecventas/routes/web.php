<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VendedorController;
use App\Http\Controllers\GerenteController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/vendedor', [VendedorController::class, 'index'])->name('vendedor.home')->middleware('role:vendedor');
    Route::get('/gerencia', [GerenteController::class, 'index'])->name('gerente.home')->middleware('role:gerente');
});


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Auth::routes();


// Rutas para el controlador de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
