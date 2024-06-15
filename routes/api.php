<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// dont forget the api prefix you donkey

//////////////////////////////////////////////////////////////////////////////
// NOTE: all these routes have to pass through a middleware to be checked. otherwise it would cause trouble, making 
// it possible to manipulate the database without authentication by just forging the urls. this is  not bonita!
// The authentication itself might be by my implementation, or i might just use sanctum or something. dont know yet.

// test
Route::get('test', [PostController::class, 'test']);

// Create post
Route::post('/createpost',[PostController::class, 'createPost']);

// Delete post
Route::delete('/delete/{id}',[PostController::class, 'deletePost']);

// Edit post
// put is sufficient since the posts are small so there is not a huge payload.
// patch could be used to partially upgrade.
Route::put('/edit/{id}', [PostController::class, 'editPost']);

// Get random posts
Route::get('/fetchposts', [PostController::class, 'fetchPosts']);