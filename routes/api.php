<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->get('/test', function () {
    return response()->json(['message' => 'API funcionando!']);
});

// para pega o toker de acesso somente para administradores
Route::post('login', [AuthController::class, 'login']);



Route::get('/users', [UserController::class, 'index']);


Route::middleware(['admin'])->group(function () {

    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

