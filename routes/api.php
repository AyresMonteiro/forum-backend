<?php

use App\Http\Controllers\SubtopicController;
use App\Http\Controllers\AuthController;
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

Route::group(['prefix' => 'users'], function () {
  Route::get("/", [UserController::class, "index"]);
  Route::post("/store", [UserController::class, "store"]);
  Route::post("/login", [AuthController::class, "login"]);
  Route::get("/{id}", [UserController::class, "show"]);
});

Route::group(['prefix' => 'topics'], function() {
  Route::get("/", [TopicController::class, "index"]);
  Route::post("/store", [TopicController::class, "store"])->middleware("auth", "admin");
  Route::get("/{id}", [TopicController::class, "show"]);
});

Route::group(['prefix' => 'subtopics'], function() {
  Route::get("/{id?}", [SubtopicController::class, "index"]);
  Route::post("/store", [SubtopicController::class, "store"])->middleware("auth", "admin");
  Route::get("/show/{id}", [SubtopicController::class, "show"]);
});

Route::group(['prefix' => 'posts'], function() {
  Route::get("/{id}", [PostController::class, "show"]);
  Route::post("/store", [PostController::class, "store"])->middleware("auth");
});

Route::group(['prefix' => 'comments'], function() {
  Route::post("/store", [CommentController::class, "store"])->middleware("auth");
});

