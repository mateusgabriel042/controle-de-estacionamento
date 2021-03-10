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
        $validator = Validator::make($request->only(['email', 'password']), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    //registra o usuario
    public function register(Request $request) {
        $validator = Validator::make($request->only(['name', 'email', 'password', 'password_confirmation']), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
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
        return response()->json(auth('api')->user());
    }

    //cria o token do usuario
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
