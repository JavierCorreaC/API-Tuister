<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function createLikePost(Request $request){
        $data = $request->json()->all();

        try{
            $like = Like::create([
                "user_id"=>$data["user_id"],
                "post_id"=>$data["post_id"]
            ]);
            return response()->json([$like],201);
        }
        catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo"=>500);
            return response()->json($respuesta,500); 
        }
    }

    public function createLikeCommentary(Request $request){
        $data = $request->json()->all();

        try{
            $like = Like::create([
                "user_id"=>$data["user_id"],
                "commentary_id"=>$data["commentary_id"]
            ]);
            return response()->json([$like],201);
        }
        catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo"=>500);
            return response()->json($respuesta,500); 
        }
    }

    public function getLikes(){
        $likes = Like::all();
        return response()->json([$likes],200);
    }

    public function getLikesbyID($id){
        $likes = Like::find($id);
        return response()->json([$likes],200);
    }

    public function getLikesbyUserID($id){
        $likes = Like::where(['user_id'=>$id])->get();
        return response()->json($likes,200);
    }

    public function getLikesbyPostID($id){
        $likes = Like::where(['post_id'=>$id])->get();
        return response()->json($likes,200);
    }

    public function getLikesbyCommentaryID($id){
        $likes = Like::where(['commentary_id'=>$id])->get();
        return response()->json($likes,200);
    }

    public function updateLikePost(Request $request, $id){
        $data = $request->json()->all();
        $like = Like::find($id);
        $like->user_id = $data["user_id"];
        $like->post_id = $data["post_id"];

        $like->save();
        return response()->json($like,200);
    }

    public function updateLikeCommentary(Request $request, $id){
        $data = $request->json()->all();
        $like = Like::find($id);
        $like->user_id = $data["user_id"];
        $like->commentary_id = $data["commentary_id"];

        $like->save();
        return response()->json($like,200);
    }

    public function deleteLike($id){
        $like = Like::find($id);
        $like->delete();
        return response()->json(["deleted"],204);
    }
}