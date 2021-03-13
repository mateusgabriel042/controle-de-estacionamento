<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller {
	public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    //loga o usuario
    public function login(Request $request){
        //validando dados do login
        $validator = Validator::make($request->only(['email', 'password']), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        //retornando resposta de erro de validacao
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //verificando se o usuario esta registrado no sistema, se sim o token de acesso eh gerado
        if (! $token = auth('api')->attempt($validator->validated())) {
            //retorno de erro em json caso o usuario nao esteja registrado
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    //registra o usuario
    public function register(Request $request) {
        //validando dados do registro
        $validator = Validator::make($request->only(['name', 'email', 'password', 'password_confirmation']), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        //retornando resposta de erro de validacao
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        //registrando o usuario
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]//criptografando senha
        ));

        return response()->json([
            'message' => 'User successfully registered!',
            'user' => $user
        ], 201);
    }

    //terminar sessao
    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    //atualizar o token
    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }

    //rotorna os dados do usuario logado
    public function userProfile() {
        //retorno em json dos dados do usuario logado
        return response()->json(auth('api')->user());
    }

    //cria o token do usuario
    protected function createNewToken($token){
        //resposta do token em json
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
