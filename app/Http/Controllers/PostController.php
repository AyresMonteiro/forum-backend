<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "body" => "required",
            "owner_subtopic" => ['required', 'numeric', 'exists:subtopics,id'],
        ], [
            'title.required' => 'Envie um título!',
            'body.required' => 'Envie um body!',
            'owner_subtopic.required' => 'Envie o subtópico do qual pertence!',
            'owner_subtopic.numeric' => 'Subtópico inválido!',
            'owner_subtopic.exists' => 'Subtópico inválido!',
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

        try{
            Post::create([
                "title" => $request->title,
                "body" => $request->body,
                "owner_subtopic" => $request->owner_subtopic,
                "owner_user" => $request->decodedId
            ]);
            
            $post = Post::where(["owner_subtopic" => "99185406863474706", "owner_user" => "99185406863474704"])->first();

            return response()->json(['message' => 'ok', 'post' => $post], 201);
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
            $post = Post::with("comments")->find("$id");

            if (!$post) {
                return response(['message' => 'error', 'errors' => "Post não encontrado"], 404);
            }

            return response(['message' => 'ok', 'post' => $post], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }
}
