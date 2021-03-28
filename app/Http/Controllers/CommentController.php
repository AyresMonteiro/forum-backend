<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "body" => "required",
            "owner_post" => ["required", "numeric", "exists:posts,id"]
        ], [
            'body.required' => 'Envie um body!',
            "owner_post.required" => "Envie um post!",
            "owner_post.numeric" => "Post inválido!",
            "owner_post.exists" => "Post não encontrado!"
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
            Comment::create([
                "body" => $request->body,
                "owner_post" => $request->owner_post,
                "owner_user" => $request->decodedId
            ]);

            $comment = Comment::where(["owner_post" => $request->owner_post,"owner_user" => $request->decodedId])->first();

            return response()->json(['message' => 'ok', 'comment' => $comment], 201);
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
            $Comment = Comment::find($id);

            if (!$Comment) {
                return response(['message' => 'error', 'errors' => "Comment não encontrado"], 404);
            }

            return response(['message' => 'ok', 'Comment' => $Comment], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }
}
