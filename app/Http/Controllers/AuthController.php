<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required",
        ], [
            'email.required' => 'Envie um email!',
            'password.required' => 'Envie uma senha!',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->getMessageBag()->getMessages() as $field) {
                foreach ($field as $message) {
                    array_push($errors, $message);
                }
            }
            return response()->json(['message' => 'error', 'errors' => $errors], 400);
        }

        $user = User::where('email', '=', $request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)) 
            return response()->json(['message' => 'error', 'errors' => "E-mail ou senha inválido!"], 400);

        $accessToken = $user->createToken("access_token")->accessToken;

        return response(["message" => "ok", "user" => $user, 'access_token' => $accessToken]);
    }
}