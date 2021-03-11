<?php

namespace App\Helpers\acl;

use Auth;
use App\User;

class Accesse {
    
    public static function validateAccesse($accesse){
        /*-----------------------------------------------------------------------------
        * Funcao que verifica se o usuario tem acesso
        *------------------------------------------------------------------------------
        *Caso o usuario nao tenha acesso o erro 403 sera lancado
        *Erro 403 - Usuario nao autorizado
        *------------------------------------------------------------------------------
        */
        if (Auth('api')->user()->hasPermissionTo($accesse)){
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
    }
}
