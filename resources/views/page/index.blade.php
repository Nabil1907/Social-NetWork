@extends('layouts/app')
@section('content')
<div class="container-fluid">
@if(!$pages->count())
<h1>There is no pages to show, <a href="{{route('page.create')}}">Create one ?</a></h1>
@else
<h1>All Pages</h1>
@endif
@foreach($pages as $page)
      <div class="card bg-dark border-light" style="width: 19rem;">
        <div class="card-body text-white">
          <h5 class="card-title font-weight-bolder">{{$page['page_name']}}</h5>
          <h6 class="card-subtitle mb-2 text-muted">page owner</h6>
          <p class="card-text">{{$page['description']}}</p>
          <a href="{{route('page.show', $page['id'])}}" class="btn btn-light text-dark font-weight-bold">Show</a>
          <a href="{{route('page.edit', $page['id'])}}" class="btn btn-success text-light font-weight-bold">Edit</a>
          {{-- <a href="" class="btn btn-primary text-light font-weight-bold likebtn">Like</a> --}}
          @php
            $like_count=0;
            $like_status="btn btn-secondary";
            $like_int=0;
          @endphp
          
          @foreach ($page->PagesLikes as $PageLike)
              @php
                if ($PageLike->like==1) {
                  $like_count++;
                }
                if(Auth::check())
                {
                    if($PageLike->like==1 && $PageLike->owner_id==Auth::user()->id)
                    {
                      $like_status="btn btn-primary";
                      
                      $like_int=1;
                    }
                }
              @endphp
          @endforeach

          <button type="button"  data-like={{$like_status}}  data-Page={{$page->id}} data-token="{{Session::token()}}" data-owner={{Auth::user()->id}}
            class="pageslikes btn {{$like_status}} text-light font-weight-bold ">
            Like 
            <span class="glyphicon glyphicon-thumbs-up"></span>
            <b><span class="like_count">{{$like_count}}</span></b>
          </button>



          <form class="float-right" method="POST" action="{{ route('page.destroy', $page['id']) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger text-light font-weight-bold">Delete</button>
          </form>
        </div>
      </div>
@endforeach
</div>
@endsection


