@extends('layouts.app')
@section('content')

<div class="container" id="cont" >

<div id="cont2">
    <p> Create Post </p>
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
    <form action="{{route('home-post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <a href="#" role="button">
                <img src="{{ URL::to('/') }}/uploaded/{{Auth::user()->profile_photo}}" style="width:32px; height:32px;  border-radius:50%; margin:5px">  <span class="caret"></span>
            </a>
                <input type="text" name="body" class="form-control" placeholder="What's Your Mind , {{ Auth::user()->name}}">
            @if ($errors->has('body'))
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('body') }}</strong>
            </span>
           @endif
                </div>
                <label id= "cont3" for="files" class="btn"> <i class="fa fa-picture-o" aria-hidden="true"></i> Photo</label>
                <input id="files"  name="image"  style="" type="file" onchange="readURL(this);"><br>
                <img id="blah" src="" alt="your image" style='display:none;' />
                @if ($errors->has('image'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            <br>

        <br>
        <input type="submit" value="Share !" class="btn btn-primary" style="width:100px"/>
	</form>
<div>
<script>
function readURL(input) {
        $("#blah").show();
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
