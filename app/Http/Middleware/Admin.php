<?php

namespace App\Http\Middleware;
use Closure;
use \App\Models\User;

class Admin
{
    public function handle($request, Closure $next)
    {
        $user = User::find($request->decodedId);

        if($user->account_type !== "admin")
            return response()->json(["message" => "error", "errors" => "Usuário não é admin!"], 401);

        return $next($request);
    }
}
