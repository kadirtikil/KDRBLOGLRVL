<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    // TEST API
    public function test() {
        return response()->json(['message' =>  "Hello from the API!"]);
    }


    // Create post
    public function createPost(Request $request) {
        // filter data from the request
        $title = $request->input("title");
        $description = $request->input("description");
        $tags = $request->input("tags");
        $author = $request->input("author");
        $data = [$title, $description, $tags, $author];

        // function to check / sanitize the input data before creating new row.
        $temp = PostController::checkRequestInputForCreatePost($data);

        // execute the query if it doesnt already exist right.....
        // so check if this entry already kind of exists. 
        $dripCheck = DB::select('select * from posts where title = ?', [$title]);
        
        // thene execute the insert query.
        if($dripCheck){
            return response()->json(["messagee" => "no bonita"]);
        }
        else{
            DB::insert('insert into posts (title, description, tags, author, created_at, updated_at) values (?, ?, ?, ?, ?, ?)',
                [$title, $description, $tags, $author, Carbon::now(), Carbon::now()]);
            return response()->json(["message" => "all good under the hood"]);
        }
        // in go i would now just handle the error god i love golang. but now i gotta fetch n check.



        // might so some function to handle this.
        return response()->json(['message' =>  "this shouldve not happened lol"]);
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
        // fetch something from the backend
        $posts = DB::table('posts')->get();
        return response()->json(['ok' => $posts]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function checkRequestInputForCreatePost($input) {
        // return val

        if(sizeof($input) < 4){
            return [];
        }
        $returnVal = [];
        foreach($input as $elem){
           if(gettype($elem) == "string"){
               $elem = filter_var($elem, FILTER_SANITIZE_STRING);
               array_push($returnVal, $elem);
            } else {
            return [];
           }
        }
    
        return $returnVal;
    }
}
