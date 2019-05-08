<?php

namespace App\Http\Controllers\Profile;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherUsersProfileController extends Controller
{
    
    public function index($id)
    {
        $user = User::where('id' , $id)->first();
        if(!$user)
          {
            abort(404);
          }  

          $post = Post::all()->where('user_id',$id);
          $arr = array('post' =>$post);
          return view('/profile/others',$arr,compact('user'));
    }
}
