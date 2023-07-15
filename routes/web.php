<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $posts = [];
    $userData = '';
    if (auth()->check()){
        $posts = auth()->user()->userCoolPost()->latest()->get();
        $userData = auth()->user()->name;
    }
    //$posts = Post::where('user_id', auth()->id())->get();
    //$posts = Post::all();
    return view('home', ['posts'=> $posts, 'user' => $userData]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Blog post related routes/* */ 

Route::post('/create-post', [PostController::class, 'createPost'] );
Route::get('edit-post/{post}',[PostController::class, 'showEditScreen']);
Route::put('edit-post/{post}',[PostController::class, 'acctuallyUpdatePost']);
Route::delete('delete-post/{post}',[PostController::class, 'deletePost']);
