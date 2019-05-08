<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PagesLikes;
use Auth;
use DB;

class PageLikesController extends Controller
  {

   public function StorePagesLikes(Request $request)
   {
    
     $user_id = Auth::user()->id;
    
    $result=DB::table('Pages_Likes')
    ->where("page_id",$request->page_id)
    ->where('owner_id',$request->owner_id)->first();
     
      if(!$result) 
     { 
       $new_Page_like = new PagesLikes();
       $new_Page_like->owner_id   = $request->owner_id ; 
       $new_Page_like->page_id= $request->page_id;
       $new_Page_like->like = 1; 
       $new_Page_like->save();

       $is_like = 1 ; 
     }
     else if($result->like ==1) 
     {
      DB::table('Pages_Likes')
      ->where("page_id",$request->page_id)
      ->where('owner_id',$request->owner_id)
      ->delete();

      $is_like = 0 ; 

     }
 /*     else if($result->like==0){

      DB::table('Pages_Likes')
      ->where("page_id",$request->page_id)
      ->where('owner_id',$request->owner_id)
      ->update(['like'=> 1] );
      $is_like = 1 ; 
     } */
     $response=array('is_like' =>$is_like );
          return response()->json($response,200);
      /*return response()->json([$request->all()],200);  */
    }
}
