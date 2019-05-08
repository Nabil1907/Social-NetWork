<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\User;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class HomePostController extends Controller
{
    public function __construct(){
      $this->middleware('verified');
    }
    // store = action
    // create = view
    public function create(){
        return view('post/createpost');
    }
    public function store(Request $request){
        $request->validate([
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            ]);
            $post              = new Post();
        $post->body        = $request->input('body');
        $post->user_id     = Auth::user()->id;
        $image             = $request->file('image');
        $new_name          = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path("image"),$new_name);

        $post->image    = $new_name ;
        $post->save();
        return redirect(route('home'));
    }

    public function index()
    {
        // $post = Post::all();
        $post = User::findOrFail(auth()->id())->post;
        $arr = array('post' =>$post);
        return view('home',$arr);
    }
    public function delete(Request $request)
    {
        Like::where('post_id',$request->post_id)->delete();
        //Comment::where('post_id',$request->post_id)->delete();
        DB::table('posts')
        ->where('id',$request->post_id)
        ->delete();
        return redirect(route('home'));

    }
    public function edit(Request $request)
    {
        $post = Post::find($request->input('post_id'));
        $post->body = $request->input('body');
        $post->save();
        return redirect(route('home'));

    }
    public function show(Request $request)
    {

        $post = DB::table('posts')->where('id',$request->post_id)->first();
        return view('post.edit',compact('post'));
    }
}
