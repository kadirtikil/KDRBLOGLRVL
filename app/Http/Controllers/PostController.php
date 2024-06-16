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
        // sanitize the id from the url first
        $id = filter_var($id, FILTER_SANITIZE_STRING);


        // ok first check if the post exists;
        $dripCheck = DB::select('select * from posts where id = ?', [$id]);

        if($dripCheck){
            // delete the row
            DB::table('posts')->where('id', '=', $id)->delete();
        } else {
            // if it doesnt exist it cannot be deleted. 
            return response()->json(["message" => "no bonita"], 400);
        }

        return response()->json(['message' => "all good under the hood"]);
    }

    // Edit post
    public function editPost(Request $request, $id) {
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $title = $request->input('title');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $author = $request->input('author');
        $data = [$title, $description, $tags, $author];

        // here we got to check if the current user matches the one in the request 
        // and then find the row with the id and check if the author matches there as well
        // then let the editing take place.

        // will have to figure out how to handle the authentication before doing that. 
        // should i do it myself or use sanctum.....


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
