@extends('layouts.app')
@section('content')

<div class="container" id="cont" >
    
<div id="cont2"> 
    <p> Edit Post </p> 
 </div>

 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route('home-post.edit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"> 
            <a href="#" role="button">   
                <img src="{{ URL::to('/') }}/uploaded/{{Auth::user()->profile_photo}}" style="width:32px; height:32px;  border-radius:50%; margin:5px">  <span class="caret"></span>
            </a>
                <input type="text" name="body" class="form-control" value="{{$post->body}}">
            @if ($errors->has('body'))
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('body') }}</strong>
            </span>
           @endif
                </div>
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <label id= "cont3" for="files" class="btn"> <i class="fa fa-picture-o" aria-hidden="true"></i> Photo</label>
                <input id="files"  name="image" value="{{$post->image}}" style="visibility:hidden;" type="file" onchange="readURL(this);">
                <img id="blah" src="/image/{{$post->image}}" alt="your image" width="500px"/>
            @if ($errors->has('image'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
            <br>
            
        <br> 
        <input type="submit" value="Edit !" class="btn btn-primary" style="width:100px"/>
	</form>
<div>
<script> 
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(500)
                    .height(300);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
@endsection