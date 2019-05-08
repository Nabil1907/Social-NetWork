<?php

namespace App\Http\Controllers\Timeline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;

class TimelineController extends Controller
{
    public function __construct(){
      $this->middleware('verified');
    }

    public function index(){
      // There is no relation to get Friends posts directly
      $auth_posts = User::findOrFail(auth()->id())->post;
      $all_posts = $auth_posts;
      $friends = DB::table('user_friends')->where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id())->where('is_accepted', True)->get();
      foreach($friends as $friend){
        $id = $friend->sender_id;
        if($id == auth()->id()){
          $id = $friend->receiver_id;
        }
        $friend_posts = User::findOrFail($id)->post;
        foreach($friend_posts as $fp){
          $all_posts[] = $fp;
        }
      }
      // dd($all_posts);
      // return $friends;
      return view('timeline/timeline', compact('all_posts'));
    }
}
