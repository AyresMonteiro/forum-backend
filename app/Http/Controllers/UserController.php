<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all();
            return response()->json(['message' => 'ok', 'users' => $users], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => ["required", "unique:users", "max:20"],
            "email" => ["required", "unique:users"],
            "full_name" => "max:80",
            "country" => "required",
            "password" => "required",
        ], [
            'username.required' => 'Envie um apelido!',
            'username.unique' => 'Esse apelido já pertence à outra pessoa!',
            'username.max' => 'Envie um apelido de até 20 caracteres!',
            'email.required' => 'Envie um email!',
            'email.unique' => 'Esse endereço de email já pertence à outra pessoa!',
            'country.required' => 'Envie um país de origem!',
            'full_name.max' => 'O nome tem um tamanho grande demais!',
            'password.required' => 'Envie uma senha!'
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

        try {
            $user = User::create([
                "username" => $request->username,
                "email" => $request->email,
                "full_name" => $request->full_name,
                "country" => $request->country,
                "password" => Hash::make($request->password)
            ]);
            $user = User::where('email', '=', $request->email)->first();

            return response()->json(['message' => 'ok', 'user' => $user], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }

    public function show($id)
    {
        $validator = Validator::make([
            'id' => $id
        ], [
            'id' => ['required', 'numeric']
        ], [
            'id.required' => 'Busca inválida!',
            'id.numeric' => 'Busca inválida!',
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

        try {
            $user = User::find($id);

            if (!$user) {
                return response(['message' => 'error', 'errors' => "Usuário não encontrado"], 404);
            }

            return response(['message' => 'ok', 'user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }
}