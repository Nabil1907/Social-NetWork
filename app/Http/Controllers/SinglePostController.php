<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class SinglePostController extends Controller
{
   public  function index($id)
   { 
   $post = Post::findOrFail($id); 
   return view('post.singlepost')->withPost($post);

   }
}
