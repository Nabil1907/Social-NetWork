<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\PagePost;

class PagePostController extends Controller
{
  public function __construct(){
    $this->middleware('verified');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //return dd(request(['body', 'page_id', 'for_page']));
      $request->validate([
        'body' => 'required|string'
      ]);
      if($post = Post::create(['body'=>request('body'), 'user_id' => auth()->id(), 'for_page'=>true])){
        if($page_post = PagePost::create(['post_id'=>$post->id, 'page_id'=>request('page_id')])){
          return redirect(route('page.show', ['id'=> request('page_id')]))->with('success', 'Successfuly add post to the page.');
        }else{ // Cannot add post to the page
          return redirect(route('page.show', ['id'=> request('page_id')]))->with('error', 'Failed to add post to the page.');
        }
      }else{ // Cannot add post
          return redirect(route('page.show', ['id'=> request('page_id')]))->with('error', 'Failed to create a new post.');
      }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\PagePost  $pagePost
   * @return \Illuminate\Http\Response
   */
  public function show(PagePost $pagePost)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\PagePost  $pagePost
   * @return \Illuminate\Http\Response
   */
  public function edit(PagePost $pagePost)
  {
    //return dd($pagePost->id);
    $post = Post::find($pagePost->post_id);
    if($post->user_id == auth()->id()){
      return view('/page/page_post_edit', compact('pagePost'));
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\PagePost  $pagePost
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, PagePost $pagePost)
  {
      if($pagePost->post['user_id'] == auth()->id()){
        $request->validate([
          'body' => 'required|string',
        ]);
        $post = $pagePost->post;
        if($post->update(request(['body']))){
          return redirect(route('page.show', ['id'=>$pagePost['page_id']]));
        }else{ // Cannot update the post
          return redirect(route('page.show', ['id'=>$pagePost['page_id']]))->with('error', 'Cannot update the post');
        }
      }else{ // The user dont have access for this post
        return redirect(route('page.show', ['id'=>$pagePost['page_id']]))->with('error', 'Cannot update the post, you do not have access');
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\PagePost  $pagePost
   * @return \Illuminate\Http\Response
   */
  public function destroy(PagePost $pagePost)
  {
      //return dd($pagePost);
      if($pagePost){
        $page_id = $pagePost['page_id'];
        if($pagePost->delete()){
          return redirect(route('page.show', ['id'=> $page_id]));
        }else{ // Cannot delete this post
          return redirect(route('page.show', $pagePost['id']))->with('error', 'Cannot delete the post');
        }
      }else{ // The user dont have access for this post
        return redirect(route('page.show', $pagePost['id']))->with('error', 'Cannot edit this post, you do not have access');
      }
  }
}
