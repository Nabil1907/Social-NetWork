<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use DB;

class HomeLikeController extends Controller
{
    public function store(Request $request)
    {
     $post_id =$request->post_id;
     $user_id = Auth::user()->id;
     $result = DB::table('likes') 
     ->where('post_id',$post_id)
     ->where('user_id', $user_id)
     ->first(); 

     if(!$result) //create new like 
     { 
       $new_like = new Like();
       $new_like->user_id   = $user_id ; 
       $new_like->post_id= $post_id;
       $new_like->like      = 1 ; 
       $new_like->save();

       $is_like = 1 ; 
     }
     else if($result->like ==1) //delete like 
     {
      DB::table('likes')
      ->where('post_id',$post_id)
      ->where('user_id', $user_id)
      ->delete();

      $is_like = 0 ; 

     }
     
    $response = array(
    'is_like' =>$is_like, 
    );

    return response()->json($response,200);
    }

}
