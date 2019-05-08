@extends('layouts.app')
@section('content')


   <div class="container">

   	<h1 class="text-center"> Posts</h1>

   		   @foreach($all_posts as $post)
         @if(!$post->for_page)
        <div style="background-color: #f2f2f2;" class="col-md-8 col-md-offset-2 mb-4">
          <div style=" font-size: 22px;">
          <a href="{{ route('user-profile-data', ['id'=>$post->user_id]) }}" >

           <img src="{{ URL::to('/') }}/uploaded/{{$post->user->profile_photo}}" style="width:50px; height:50px;  border-radius:50% ; margin-top: 10px; margin-bottom: 15px;">
                                      {{$post->user->name}}
            </a>
       @if(Auth::user()->id==$post->user->id)
       <div class="dropdown" style="float:right; margin-top:20px;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Edit / Delete
<!-- <<<<<<< HEAD -->
        </button>
<!-- ======= -->
        </button>
<!-- >>>>>>> cfa2ddabdc1c083318a22cd5e085f8cfdf70a81f -->
        <ul class="dropdown-menu">
          <li>
              <form enctype="multipart/form-data" action="{{route('home-post.show')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <input type="submit" name="edit" value=" Edit"  class="text-left btn btn-block">
              </form>
          </li>
          <li>
          <form enctype="multipart/form-data" action="{{route('home-post.delete')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="post_id" value="{{$post->id}}">
          <input type="submit" name="Delete" value="Delete" class="text-left btn btn-block text-danger" >
          </form>
          </li>
        </ul>
      </div>

        @endif

          </div>

    <div class="thumbnail" >
    <h5 class="ArticleBody">
            {{ str_limit(strip_tags($post->body), 50) }}
    </h5>

            @if (strlen(strip_tags($post->body)) > 50)
              ...


              <a href='{{ "/read/".$post->id }}'>Read More<i class="fas fa-angle-right"></i></a>
              <br>
            @endif
        <div class="clearfix"></div>
        <div class="text-center">
          <br>
          <a href="{{route('home-posts.single',[$post->id])}}">
          <img src="/image/{{$post->image}}" class="img-thumbnail" style="margin-top:-20px;">
          </a>
        </div>
        <div class="caption">

        </div>
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
        <button type="button" class="like btn btn-light btn-block" post_id ="{{$post->id}}" >
          <b> <span class="like_count">{{$like_count}}</span></b>
          <i class="emoji {{$like_statu}}" ></i> Like
        </button>

      </div>

      <div class="col-sm-3 col-md-6">
        <button type="button" class="btn btn-light btn-block"><i class="far fa-comment"></i> Comment</button>

      </div>
      </div>
    </div>
    </div>
    <br/>
             @endif
             @endforeach

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
