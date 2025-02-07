<?php

use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Login
Route::post('/login', [UserController::class, 'login'])->middleware('guest');

//Pedido
Route::apiResource('/pedido', PedidoController::class)->middleware('auth:sanctum');

//Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
