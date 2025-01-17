<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $messages = [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
            'status' => 'error',
            'message' => 'Erro de autenticação.',
            'errors' => $validator->errors(),
        ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas '], 401);
        }

        if($user->tipo !== "admin"){
            return response()->json(['message' => 'Você não tem permissão de administrador'], 403);
        }

        $token = Str::random(60);

        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'token' => $token
        ], 200);

    }
}
