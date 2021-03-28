<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $topics = Topic::with('subtopics.latestPost')->get();

            return response()->json(['message' => 'ok', 'topics' => $topics], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topicValues = [
            'title' => $request->title
        ];

        $validator = Validator::make($topicValues, [
            'title' => ['required', 'string', 'unique:topics']
        ], [
            'title.required' => 'Envie um título!',
            'title.string' => 'Título inválido!',
            'title.unique' => 'Esse tópico já existe!',
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
            $topic = Topic::firstOrCreate($topicValues);
            $topic = Topic::where('title', '=', $topicValues['title'])->first();

            return response()->json(['message' => 'ok', 'topic' => $topic], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
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
            $topic = Topic::with('subtopics.latestPost')->find($id);

            if (!isset($topic)) {
                $status = 404;
            }

            return response()->json(['message' => 'ok', 'topic' => $topic], $status);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'errors' => ['Erro do servidor']], 500);
        }
    }
}