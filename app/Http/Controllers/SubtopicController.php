<?php

namespace App\Http\Controllers;

use App\Models\Subtopic;
use App\Models\Topic;
use Illuminate\Http\Request;

class SubtopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required",
            "owner_topic" => "required",
        ]);

        Subtopic::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subtopic = Subtopic::find($id)->posts;
        if ($subtopic == null) {
            return View("subtopic.notFound", [], 404);
        }
        return response($subtopic, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function edit(Subtopic $subtopic)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtopic $subtopic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subtopic  $subtopic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtopic $subtopic)
    {
        //
    }
}
