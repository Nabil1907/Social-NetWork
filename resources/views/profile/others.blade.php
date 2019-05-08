@extends('layouts.app')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- //////////////////////////////////////////////////////////////////////////////////////// --}}
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">

        <div class="col-md-12 " style="margin:10px; margin-left:0px;">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>User Profile</h4></div>
                <div class="panel-body">

                    <div class="box box-info">

                        <div class="box-body">
                            <div class="col-sm-6">
                                <div align="center"> <img alt="User Pic" src="/uploaded/{!! $user->profile_photo; !!}" id="profile-image1" class="img-circle img-responsive">

                                    <!--Upload Image Js And Css-->

                                </div>

                                <br>

                                <!-- /input-group -->
                            </div>
                            <div class="col-sm-6">
                              <a href="{{ route('user-profile-data', ['id'=>$user->id]) }}"><h4 style="color:#00b1b1;">{!! $user->name; !!}</h4></span></a>
                                <span><p>{!! $user->autobio; !!}</p></span>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="margin:5px 0 5px 0;">

                            <div class="col-sm-5 col-xs-6 tital ">User Name:</div>
                            <div class="col-sm-7">{!! $user->name; !!}</div>
                            <div class="clearfix"></div>

                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital ">Email:</div>
                            <div class="col-sm-7">{!! $user->email; !!}</div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital ">Date Of Birth:</div>
                            <div class="col-sm-7">{!! $user->dob; !!}</div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital ">Gender:</div>
                            <div class="col-sm-7">{!! $user->gender; !!}</div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="col-sm-5 col-xs-6 tital ">Country:</div>
                            <div class="col-sm-7">{!! $user->country; !!}</div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                        </div>
                        <!-- /.box -->

                    </div>

                </div>
            </div>
            
        
        </div>

    </div>
</div>
<div class="container">

    <h1 class="text-center" > Posts</h1>

            @foreach($post as $art)
    <div style="background-color: #f2f2f2; " class="col-md-8 col-md-offset-2 mb-4">
      <div style=" font-size: 22px;" class="">
        <a href="{{ route('user-profile-data', ['id'=>$art->user_id]) }}" >
       <img src="{{ URL::to('/') }}/uploaded/{{$user->profile_photo}}" style="width:50px; height:50px;  border-radius:50% ; margin-top: 10px; margin-bottom: 15px;">
                                  {{$art->user->name}}
        </a>
   @if(Auth::user()->id==$art->user->id)
   <div class="dropdown" style="float:right; margin-top:20px;">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Edit / Delete 
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li>
          <form enctype="multipart/form-data" action="{{route('home-post.show')}}" method="post"> 
          {{ csrf_field() }}
          <input type="hidden" name="post_id" value="{{$art->id}}">
          <input type="submit" name="edit" value=" Edit"  class="btn btn-default">
          </form> 
      </li>
      <li>
      <form enctype="multipart/form-data" action="{{route('home-post.delete')}}" method="post"> 
      {{ csrf_field() }}
      <input type="hidden" name="post_id" value="{{$art->id}}">
      <input type="submit" name="Delete" value="Delete" class="btn btn-default" >
      </form>
      </li>
    </ul>
  </div> 

    @endif 

      </div>

<div class="thumbnail" style="" >
<h5 class="ArticleBody">
        {{ str_limit(strip_tags($art->body), 50) }}

    </h5>

        @if (strlen(strip_tags($art->body)) > 50)
          ...


          <a href='{{ "/read/".$art->id }}' >Read More<i class="fas fa-angle-right"></i></a>
          <br>
        @endif
        <p style="" class="float-right">
        {{$art->created_at}}
    </p><div class="clearfix"></div>
 <a href='{{ "/read/".$art->id }}'>
    <img src="/image/{{$art->image}}" class="img-thumbnail" style="margin-top:-20px;">
    <div class="caption">

    </div>
  </a>
  @php
     $like_count = 0 ;
     $like_statu = "far fa-thumbs-up";
   @endphp


   @foreach($art->like as $like)
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
    <button type="button" class="btn-block like btn btn-light" style=""  post_id ="{{$art->id}}" >
      <b> <span class="like_count">{{$like_count}}</span></b>
      <i class="emoji {{$like_statu}}" ></i> Like
    </button>

  </div>

  <div class="col-sm-3 col-md-6">
    <button type="button" class="btn-block btn btn-light" style=""><i class="far fa-comment"></i> Comment</button>

  </div>
  </div>
</div>
</div>
<br/>

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