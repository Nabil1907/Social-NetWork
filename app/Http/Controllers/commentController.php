<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use Auth;
use Session;

class commentController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'exists:posts,id|numeric' ,
            'comment' => 'required|max:225'
        ]);
        $comment = new comment;
        $comment->body = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();

        Session::flash('success', 'Your Comment was succesfully added');
        return redirect()->back();



    }

}
