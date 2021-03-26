<?php

use App\Http\Controllers\SubtopicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::get("/users", [UserController::class, "index"]);
Route::get("/users/{id}", [UserController::class, "show"]);
Route::post("/users", [UserController::class, "store"]);

Route::get("/topics", [TopicController::class, "index"]);
Route::get("/topics/{id}", [TopicController::class, "show"]);

Route::get("/subtopics", [SubtopicController::class, "index"]);
Route::get("/subtopics/{id}", [SubtopicController::class, "show"]);

Route::Get("/posts/{id}", [PostController::class, "show"]);
Route::Post("/posts", [PostController::class, "store"]);

Route::Post("/posts/{id}/comments", [CommentController::class, "store"]);

/*
Não recomendo deixar essas rotas ativas, já que os tópicos/subtópicos não deveriam ser criados por usuários padrões
e a aplicação não possui uma definição de usuário administrador, deixei elas aqui por fins de testes automatizados.
 */

Route::Post("/topics", [TopicController::class, "store"]);
Route::Post("/subtopics", [SubtopicController::class, "store"]);
