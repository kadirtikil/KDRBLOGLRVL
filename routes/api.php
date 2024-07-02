<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//////////////////////////////////////////////////////////////////////////////
// NOTE: all these routes have to pass through a middleware to be checked. otherwise it would cause trouble, making
// it possible to manipulate the database without authentication by just forging the urls. this is  not bonita!
// The authentication itself might be by my implementation, or i might just use sanctum or facade or something. dont know yet.

// Ok the Auhtentication is a little more complex than originally expected. Not because of the implementation but because of
// data safety in germany. i dont want to catch a law suit becuase of this stuff so im just providing a couple log in accounts
// to anyone who wants to check out my projects. that way i dont have to deal with this stuff.

// So i will setup like 5 default users with the email provided on the website such that they can be used. or i might just make it
// such that a complaint on the website cant be edited and i therefore dont have ti safe the email persistently.

// then the deletion would take place with a password type thingy such that it can be used to delete a post.
// the password is then provided to the user and associated with the post in the db.... hmmmmmmm have to sleep about that stuff.


// test
Route::get('test', [PostController::class, 'test']);

// Routes that can only be accessed if the user is authenticated. later authorized too for the admin dashboard.


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



Route::get('/fetchrandomposts', [PostController::class, 'fetchPosts']);









