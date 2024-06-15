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
        // set up connection to DB

        // filter data from the request

        // create the query to add the data to the db

        // execute the query.

        // return the bonito or no bonita

        // might so some function to handle this.
        return response()->json(['message' =>  "createPost function called"]);
    }

    // Delete post
   public function deletePost($id) {
        return response()->json(['message' => $id]);
    }

    // Edit post
    public function editPost(Request $request, $id) {
        return response()->json(['message' => $request, 'another message' => $id]);
    }


    // Get random posts
    public function fetchPosts() {
        return response()->json(['ok' => "fetch some posts dawg"]);
    }
}
