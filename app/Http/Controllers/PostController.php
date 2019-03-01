<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        $post = new Post();
        $post->title = "Hello Mundo. Hola World";
        $post->body = "Cuerpo del post";
        $post->imagen_url = "www.google.com";
        $post->user_id = 5;

        return response()-> json($post,202);
    }

    public function createPost(Request $request){
        $data = $request->json()->all();

        try{
            if($request->hasFile('imagen')){
                if($request->file('imagen')->isValid()){
                    $destinationPath = "C:\Users\JaviCo\Desktop\lumen\proyecto\proyecto\storage\images";
                    $fileName = str_random(10);
                    $extension = $request->file('imagen')->getClientOriginalExtension();
                    $fileComplete = $fileName . "." . $extension;
                    $post = Post::create([
                        "title"=>$request->input("title"),
                        "body"=>$request->input("body"),
                        "imagen_url"=>$fileComplete,
                        "user_id"=>$request->input("user_id")
                    ]);
                    $request->file('imagen')->move($destinationPath,$fileName);

                    return response()->json([$post],201);
                }else{
                    return response()->json(["algo anda mal"],404);
                }
            }else{
                $post = Post::create([
                    "title"=>$data["title"],
                    "body"=>$data["body"],
                    "user_id"=>$data["user_id"]
                ]);
                return response()->json([$post],201);
            }
        }
        catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo"=>500);
            return response()->json($respuesta,500); 
        }
    }

    public function getPosts(){
        $posts = Post::all();
        return response()->json([$posts],200);
    }

    public function getPostsbyID($id){
        $posts = Post::find($id);
        return response()->json([$posts],200);
    }

    public function getPostsbyUserID($id){
        $post = Post::where(['user_id'=>$id])->get();
        return response()->json($post,200);
    }

    public function updatePost(Request $request, $id){
        $data = $request->json()->all();
        $post = Post::find($id);
        $post->title = $data["title"];
        $post->body = $data["body"];

        $post->save();
        return response()->json($post,200);
    }

    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();
        return response()->json(["deleted"],204);
    }

    public function uploadFile(Request $request){
        $destinationPath = "C:\Users\JaviCo\Desktop\lumen\proyecto\proyecto\storage\images";

        $fileName = "imagen.docx";
        $request->file('imagen')->move($destinationPath,$fileName);
    }
}