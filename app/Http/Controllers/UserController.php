<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //todos usuarios
    public function index()
    {
        $users=User::select('name', 'email', 'fone', 'tipo')->get();
      return response()->json($users,200);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser um texto válido.',
            'name.max' => 'O nome pode ter no máximo 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'fone.string' => 'O campo telefone deve ser um texto válido.',
            'fone.max' => 'O telefone pode ter no máximo 50 caracteres.',
            'tipo.required' => 'O campo tipo é obrigatório.',
            'tipo.in' => 'O campo tipo deve ser "admin" ou "user".',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'fone'=>'|string|max:50',
            'tipo'=>'required|string|in:admin,user',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
            'status' => 'error',
            'message' => 'Erro ao realizar o cadastro.',
            'errors' => $validator->errors(),
        ], 422);
        }
        try {
            $token = Str::random(60);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fone' => $request->fone,
                'tipo' => $request->tipo,
                'remember_token' => $token,

            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Usuário cadastrado com sucesso!',
                'user' => $user,
            ], 201);
    } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocorreu um erro inesperado .',
            ], 500);
    }
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User não existe'], 404);
        }

        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser um texto válido.',
            'name.max' => 'O nome pode ter no máximo 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'fone.string' => 'O campo telefone deve ser um texto válido.',
            'fone.max' => 'O telefone pode ter no máximo 50 caracteres.',
            'tipo.required' => 'O campo tipo é obrigatório.',
            'tipo.in' => 'O campo tipo deve ser "admin" ou "user".',
        ];

        $validator = Validator::make($request->only(['name', 'email', 'fone', 'tipo']), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'fone' => 'nullable|string|max:50',
            'tipo' => 'nullable|string|in:admin,user',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
            'status' => 'error',
            'message' => 'Erro ao realizar atualização.',
            'errors' => $validator->errors(),
        ], 422);
        }

        $Updateusers = $request->only(['name', 'email', 'fone', 'tipo']);
        $user->update($Updateusers);

        return response()->json([
            'status' => 'success',
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario não existe'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usurio deletado'], 200);
    }

}
