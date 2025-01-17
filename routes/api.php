<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->get('/test', function () {
    return response()->json(['message' => 'API funcionando!']);
});


// Rota para listar todos os usuários
Route::get('/users', [UserController::class, 'index']);

// Rota para criar um novo usuário
Route::post('/users', [UserController::class, 'store']);

// Rota para atualizar um usuário
Route::put('/users/{id}', [UserController::class, 'update']);

// Rota para deletar um usuário
Route::delete('/users/{id}', [UserController::class, 'destroy']);
