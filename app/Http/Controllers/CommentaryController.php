<?php

namespace App\Http\Controllers;

use App\Commentaries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CommentaryController extends Controller
{
    public function createCommentary(Request $request){
        $data = $request->json()->all();

        try{
            if($request->hasFile('imagen')){
                if($request->file('imagen')->isValid()){
                    $destinationPath = "C:\Users\JaviCo\Desktop\lumen\proyecto\proyecto\storage\images";
                    $fileName = str_random(10);
                    $extension = $request->file('imagen')->getClientOriginalExtension();
                    $fileComplete = $fileName . "." . $extension;
                    $commentary = Commentaries::create([
                        "body"=>$request->input("body"),
                        "imagen_url"=>$fileComplete,
                        "user_id"=>$request->input("user_id"),
                        "post_id"=>$request->input("post_id"),
                    ]);
                    $request->file('imagen')->move($destinationPath,$fileName);

                    return response()->json([$commentary],201);
                }else{
                    return response()->json(["algo anda mal"],404);
                }
            }else{
                $commentary = Commentaries::create([
                    "body"=>$request->input("body"),
                    "user_id"=>$request->input("user_id"),
                    "post_id"=>$request->input("post_id")
                ]);
                return response()->json([$commentary],201);
            }
        }
        catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo"=>500);
            return response()->json($respuesta,500); 
        }
    }

    public function getComments(){
        $comments = Commentary::all();
        return response()->json([$comments],200);
    }

    public function getCommentsbyID($id){
        $comments = Commentaries::find($id);
        return response()->json([$comments],200);
    }

    public function getCommentsbyUserID($id){
        $commentary = Commentaries::where(['user_id'=>$id])->get();
        return response()->json($commentary,200);
    }

    public function getCommentsbyPostID($id){
        $commentary = Commentaries::where(['post_id'=>$id])->get();
        return response()->json($commentary,200);
    }

    public function updateCommentary(Request $request, $id){
        $data = $request->json()->all();
        $commentary = Commentaries::find($id);
        $commentary->body = $data["body"];
        $commentary->imagen_url = $data["imagen_url"];

        $commentary->save();
        return response()->json($commentary,200);
    }

    public function deleteCommentary($id){
        $commentary = Commentaries::find($id);
        $commentary->delete();
        return response()->json(["deleted"],204);
    }

    public function uploadFile(Request $request){
        $destinationPath = "C:\Users\JaviCo\Desktop\lumen\proyecto\proyecto\storage\images";

        $fileName = "imagen.docx";
        $request->file('imagen')->move($destinationPath,$fileName);
    }
}