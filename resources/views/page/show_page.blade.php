@extends('layouts.app')
@section('content')

<div class="container">

  <form method="POST" action="{{route('pagePost.store')}}">
    @csrf
    <div class="form-group">
      <label for="pageInputPost">Create post</label>
      <input type="text" name="body" class="form-control" id="postContent" placeholder="{{Auth::user()->name}}, Share something with the group..." required>
      <input type="hidden" name="page_id" value="{{$page['id']}}">
    </div>

    <button type="submit" class="btn btn-secondary text-light font-weight-bold">Create</button>
  </form>
  <hr>

  @if($page->page_post->count())
    @foreach($page->page_post as $page_post)
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row no-gutters">
        <div class="col-md-11">
          <div class="card-body">
            <h5 class="card-title">{{Auth::user()->name}}</h5>
            <p class="card-text"><small class="text-muted">{{$page_post->post['created_at']}}</small></p>
            <p class="card-text">{{$page_post->post['body']}}</p>
          </div>
        </div>
        <div class="col-md-1">
          <div class="dropdown float-right">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                <span class="fas fa-edit"></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('pagePost.edit', $page_post['id']) }}">Edit</a>
              <form method="POST" action="{{ route('pagePost.destroy', $page_post['id']) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  @else
    <h1>Nothing to show</h1>
  @endif

</div>


@endsection
