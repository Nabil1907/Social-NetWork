@extends('layouts.app')

@section('content')
<div class="container">
  <form method="POST" action="{{ route('pagePost.update', $pagePost['id']) }}">
    @csrf
    @method('PATCH')
    <div class="form-group">
      <input type="text" name="body" class="form-control {{ $errors->has('body') ? "is-invalid" : ""}}" id="postBody" value="{{ $pagePost->post['body'] }}" required>
      @if($errors->has('body'))
      <div class="invalid-feedback">
          @foreach($errors->get('body') as $msg)
            {{$msg}}
          @endforeach
      </div>
      @endif
    </div>
    <button type="submit" class="btn btn-success">Edit</button>
  </form>
</div>
@endsection
