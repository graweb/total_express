<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Http\Resources\MensagemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @title Faz o login na plataforma
     * @param [string] $email E-mail do usuário (obrigatório)
     * @param [string] $senha Senha do usuário (obrigatório)
     * @success 201
     * @erro 401
    */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'senha' => 'required',
        ];

        $messages = [
            'email.required' => 'O campo e-mail é obrigatório!',
            'email.email' => 'Favor, digite um e-mail válido!',
            'senha.required' => 'O campo senha é obrigatório!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(new MensagemResource($validator->errors()), 401);
        } else {
            $user = User::where('email', $validator->validated()['email'])->first();

            if (!$user) {
                return response()->json(new MensagemResource("E-mail inválido."), 401);
            }

            if (!Hash::check($validator->validated()['senha'], $user->password)) {
                return response()->json(new MensagemResource('Senha inválida.'), 401);
            }

            $user->token = $user->createToken(config('app.name'))->plainTextToken;

            return response()->json(new LoginResource($user), 201);
        }
    }

    /**
     * @title Faz o logout na plataforma (enviar o token do tipo Bearer)
     * @success 200
     * @erro 401
    */
    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(new MensagemResource('Deslogado com sucesso.'), 200);
    }
}
