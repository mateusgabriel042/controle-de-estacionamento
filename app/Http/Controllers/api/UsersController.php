<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\api\User;

class UsersController extends Controller {

    //listagem dos usuarios
    public function index() {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('view_user'))
            return response()->json(['error' => 'Unauthorized'], 403);

        //retorno dos usuarios registrados
        return response()->json([
            'users' => User::all()
        ]);
    }

    //selecao do usuario
    public function show($id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('view_user'))
            return response()->json(['error' => 'Unauthorized'], 403);

        //selecionando o usuario
        try{
            $userSelected = User::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'User not found!'], 404);//retorno de erro em json caso o usuario nao seja encontrado
        }

        //retorno do usuario selecionado
        return response()->json([
            'user' => $userSelected
        ]);
    }

    //deletacao do usuario
    public function destroy($id) {
        //verificacao de acesso
        if (!Auth('api')->user()->hasPermissionTo('delete_user'))
            return response()->json(['error' => 'Unauthorized'], 403);

        //selecionando o usuario
        try{
            $userSelected = User::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'User not found!'], 404);//retorno de erro em json caso o usuario nao seja encontrado
        }

        //deletando registro do usuario
        $userSelected->delete();

        //retorno do usuario deletado
        return response()->json([
            'userDeleted' => $userSelected
        ]);
    }
}
