<?php

namespace App\Http\Controllers;

use App\Models\Subtopic;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubtopicController extends Controller
{

    public function index(Request $request)
    {
        try {
            $id = $request->id;

            if (! $id)
               return response()->json(['message' => 'ok', "subtopics" => Subtopic::all()], 200);

            $subtopics = Subtopic::with("posts")->where("owner_topic", "=", $id)->get();

            if(! sizeof($subtopics) >= 1)
                return response()->json([
                    "message" => "error", 
                    "errors" => "Subtópicos não encontrados. Você tem certeza que um tópico com esse id existe?"
                ], 404);

            return response()->json(['message' => 'ok', 'subtopics' => $subtopics], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }

    public function store(Request $request)
    {
        $subtopicValues = [
            'owner_topic' => $request->owner_topic,
            'title' => $request->title,
            'summary' => $request->summary,
        ];

        $validator = Validator::make($subtopicValues, [
            'owner_topic' => ['required', 'numeric', 'exists:topics,id'],
            'title' => ['required', 'string', 'unique:subtopics'],
            'summary' => ['required', 'string'],
        ], [
            'owner_topic.required' => 'Envie um tópico!',
            'owner_topic.numeric' => 'Tópico inválido!',
            'owner_topic.exists' => 'Tópico inválido!',
            'title.required' => 'Envie um título!',
            'title.string' => 'Título inválido!',
            'title.unique' => 'Esse subtópico já existe!',
            'summary.required' => 'Envie uma descrição!',
            'summary.string' => 'Descrição inválida!',
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
            $subtopic = Subtopic::firstOrCreate($subtopicValues);
            $subtopic = Subtopic::where('title', '=', $subtopicValues['title'])->first();

            return response()->json(['message' => 'ok', 'subtopic' => $subtopic], 201);
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
            $status = 200;
            $subtopic = Subtopic::with('posts')->find($id);

            if (!isset($subtopic)) {
                $status = 404;
            }

            return response()->json(['message' => 'ok', 'subtopic' => $subtopic], $status);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }
}