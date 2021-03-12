<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::enableQueryLog();
        // $topics = DB::table('topics')
        //     ->select([
        //         'topics.uuid as topic_uuid',
        //         'topics.title as topic_title',
        //         'topics.created_at as topic_created_at',
        //         'topics.updated_at as topic_updated_at',
        //         'subtopics.uuid as subtopic_uuid',
        //         'subtopics.title as subtopic_title',
        //         'subtopics.owner_topic as subtopic_owner_topic',
        //         'subtopics.summary as subtopic_summary',
        //         'subtopics.created_at as subtopic_created_at',
        //         'subtopics.updated_at as subtopic_updated_at',
        //         'posts.uuid as post_uuid',
        //         'posts.owner_subtopic as post_owner_subtopic',
        //         'posts.body as post_body',
        //         'posts.created_at as post_created_at',
        //         'posts.updated_at as post_updated_at'
        //     ])
        //     ->join('subtopics', 'subtopics.owner_topic', '=', 'topics.uuid')
        //     ->join('posts', function ($join) {
        //         $join
        //             ->on('posts.owner_subtopic', '=', 'subtopics.uuid')
        //             ->on('posts.created_at', '=', DB::raw('(SELECT max(created_at) from posts)'));
        //     })
        //     ->get();

        $topics = Topic::with('subtopics.posts')->get();

        return view('landing.index', ['topics' => $topics]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
