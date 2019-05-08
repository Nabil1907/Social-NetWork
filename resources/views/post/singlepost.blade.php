@extends('layouts.app')
@section('content')

   <div class="container">

   	<h1 class="text-center"> Posts</h1>

        <div style="background-color: #f2f2f2; width:820px ; height: 500px ; margin:100px; margin-left:200px;">
          <div style=" font-size: 22px; margin-left: 20px;">
            <a href="profile/{{$post->user_id}}" >

           <img src="{{ URL::to('/') }}/uploaded/{{$post->user->profile_photo}}" style="width:50px; height:50px;  border-radius:50% ; margin-top: 10px; margin-bottom: 15px;">
                                      {{$post->user->name}}
            </a>
       @if(Auth::user()->id==$post->user->id)
       <div class="dropdown" style="float:right; margin-top:20px;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Edit / Delete
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li>
              <form enctype="multipart/form-data" action="{{route('home-post.show')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <input type="submit" name="edit" value=" Edit"  class="btn btn-default">
              </form>
          </li>
          <li>
          <form enctype="multipart/form-data" action="{{route('home-post.delete')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="post_id" value="{{$post->id}}">
          <input type="submit" name="Delete" value="Delete" class="btn btn-default" >
          </form>
          </li>
        </ul>
      </div>

        @endif

          </div>

    <div class="thumbnail" style="margin-left: 10px;" >
    <h5 class="ArticleBody">
            {{ str_limit(strip_tags($post->body), 50) }}

        </h5>

            @if (strlen(strip_tags($post->body)) > 50)
              ...


              <a href='{{ "/read/".$post->id }}' >Read More<i class="fas fa-angle-right"></i></a>
              <br>
            @endif
            <p style="margin-left: 660px;">
            {{$post->created_at->toFormattedDateString()}}
        </p>
     <a href='{{ "/post/".$post->id }}'>
        <img src="/image/{{$post->image}}" class="img-thumbnail" style="margin-top:-20px;">
        <div class="caption">

        </div>
      </a>
      @php
         $like_count = 0 ;
         $like_statu = "far fa-thumbs-up";
       @endphp


       @foreach($post->like as $like)
       @php

       if($like->like==1)
       { $like_count++; }

       if(Auth::check())
       {
         if($like->like == 1 &&  $like->user_id == Auth::user()->id )
          $like_statu = "fas fa-thumbs-up";


       }

       @endphp
       @endforeach


      <div class="row">
        <div class="col-sm-3 col-md-6">
            <button type="button" class="like btn btn-light" style="width:420px"  post_id ="{{$post->id}}" >
            <b> <span class="like_count">{{$like_count}}</span></b>
            <i class="emoji {{$like_statu}}" ></i> Like
            </button>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-md-12">
            @if($post->comments->count())
                @foreach($post->comments as $comment)
                    <div class="panel panel-default" style="margin:0; border-radius:0;">
                        <div class="panel-body">
                            <p>{{$comment->body}}</p>
                            <div class="pull-right">
                                <small>Commented by {{ $comment->user->name }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if (Auth::check())
                <div class="panel panel-default" style="margin:0; border-radius:0;">
                    <div class="panel-body">
                        <form action="{{ url('/comment') }}" method = "POST" style="display:flex;">
                            {{ csrf_field() }}
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="text" name="comment" placeholder="write your Comment here...">
                            <input type="submit" value="comment" class="btn btn-primary" style="border-radius:0;">
                        </form>
                        {{--@if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <ul>
                                    @foreach ($errors->all() as &error)
                                    {{ $error }}
                                    @endforeach
                                </ul>
                            </div >
                        @endif
                         @if (Session::has('success'))
                            <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    {{Session::get('success')}}
                            </div>
                        @endif --}}
                    </div>
                </div>
            @endif
        </div>
      </div>
    </div>
    </div>
    <br/>



</div>
<script>
$(document).ready(function(){
  $(document).on('click','.like',function()
  {
    var post_id      = $(this).attr('post_id');
    $.ajax({
     type: 'POST',
     url: "{{route('like')}}",
     data:{post_id:post_id,_token:token},

     success: function(data){
      if(data.is_like == 1){
        $('*[post_id="'+ post_id +'"]').find('.emoji').removeClass('emoji far fa-thumbs-up').addClass('emoji fas fa-thumbs-up');
        var cu_like = $('*[post_id="'+ post_id +'"]').find('.like_count').text();
        var new_like= parseInt(cu_like) + 1 ;
        $('*[post_id="'+ post_id +'"]').find('.like_count').text(new_like);
      }
      else if(data.is_like == 0){
        $('*[post_id="'+ post_id +'"]').find('.emoji').removeClass('emoji fas fa-thumbs-up').addClass('emoji far fa-thumbs-up');;
        var cu_like = $('*[post_id="'+ post_id +'"]').find('.like_count').text();
        var new_like= parseInt(cu_like)- 1 ;
        $('*[post_id="'+ post_id +'"]').find('.like_count').text(new_like);
      }
    }
   });
  });
})


</script>
@endsection
