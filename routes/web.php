<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\OrdenServicioController;

Route::get('/', function () {
    return view('dashboard');
});


Route::resource('clientes', ClienteController::class);
Route::resource('usuarios', UsuarioController::class);

Route::resource('ordenes', OrdenServicioController::class)
    ->only(['index', 'create', 'store', 'edit', 'update'])
    ->parameters(['ordenes' => 'orden']);