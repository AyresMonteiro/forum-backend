<?php

namespace App\Http\Middleware;
use App\Models\User;
use PeterPetrus\Auth\PassportToken;
use \Illuminate\Support\Facades\DB;
use Closure;

class Token
{
    public function handle($request, Closure $next)
    {
        $authHeader = $request->header("Authorization");

        if(! $authHeader)
            return response()->json(["message" => "error", "errors" => "Token não enviado!"], 401);

        $parts = explode(" ", (string)$authHeader);

        if(sizeof($parts) !== 2)
            return response()->json(["message" => "error", "errors" => "Erro de token!"], 401);

        $scheme = $parts[0];
        $token = new PassPortToken($parts[1]);

        if(! $scheme === "Bearer")
            return response()->json(["message" => "error", "errors" => "Token mal-formatado!"], 401);

        // Check if token exists in DB (table 'oauth_access_tokens'), require \Illuminate\Support\Facades\DB class
        if (! $token->valid || ! $token->existsValid()) 
            return response()->json(["message" => "error", "errors" => "Token inválido!"], 401);


        if(! User::where($token->user_id))
            return response()->json(["message" => "error", "errors" => "O usuário não pode ser recuperado pelo token!"], 500);

        // $request->decodedId = $token->user_id;
        $request->request->add(['decodedId' => (int)$token->user_id]);

        // dd($request->all());

        return $next($request);
    }
}
