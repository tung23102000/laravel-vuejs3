<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// category
Route::get('categories_all', [CategoryController::class,'allCategory']);

Route::post('add_category', [CategoryController::class,'addCategory']);

Route::delete('delete_category/{id}', [CategoryController::class,'deleteCategory']);

Route::get('edit_category/{id}', [CategoryController::class,'editCategory']);

Route::post('update_category/{id}', [CategoryController::class,'updateCategory']);
// post
Route::get('posts_all', [PostController::class,'allPost']);

Route::post('add_post', [PostController::class,'addPost']);

Route::delete('delete_post/{id}', [PostController::class,'deletePost']);

Route::get('edit_post/{id}', [PostController::class,'editPost']);

Route::post('update_post/{id}', [PostController::class,'updatePost']);

Route::get('search/{data}', [PostController::class,'searchPost']);
//user
Route::get('users_all', [UserController::class,'allUsers']);

Route::post('add_user', [UserController::class,'addUser']);

Route::delete('delete_user/{id}', [UserController::class,'deleteUser']);

Route::get('edit_user/{id}', [UserController::class,'editUser']);

Route::post('update_user/{id}', [UserController::class,'updateUser']);

Route::get('searchUser/{data}', [UserController::class,'searchUser']);
//comment
Route::get('comments_all', [CommentController::class,'allComments']);

Route::post('add_comment', [CommentController::class,'addComment']);

Route::delete('delete_comment/{id}', [CommentController::class,'deleteComment']);

Route::get('searchComment/{data}', [CommentController::class,'searchComment']);

Route::post('update_comment/{id}', [CommentController::class,'updateComment']);