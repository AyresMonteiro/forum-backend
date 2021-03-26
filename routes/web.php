<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SubtopicController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get("/", [TopicController::class, "index"]);
Route::get("/subtopics/{id}", [SubtopicController::class, "show"]);

Route::Get("{id}/posts/create", function($id) {
    return view("landing.createPost", ["id" => $id]);
});

Route::Get("/posts/{id}", [PostController::class, "show"]);
