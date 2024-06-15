<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // TEST API
    public function test() {
        return response()->json(['message' =>  "Hello from the API!"]);
    }


    // Create post
   public function createPost(Request $request) {
        return response()->json(['message' =>  "nothignb"]);
    }

    // Delete post
   public function deletePost($id) {

    }

    // Edit post
    public function editPost() {

    }


    // Get random posts
    public function fetchPosts() {

    }
}
