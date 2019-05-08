@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Friends Request</h1>
  Looking for a new friend? Search for <a href="{{route('user-friend.create')}}" class="btn btn-info text-white">Potential Friends?</a>
  <div class="row">
  @foreach($friends as $friend)
  @php
    $user = \App\User::find($friend->sender_id);
  @endphp
  <div class="col-md-3 mb-4">
    <div class="card">
      <img src="{{asset($user->profile_photo)}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$user->name}}</h5>
        <p class="card-text">
          <b>Gender: </b> {{$user->genderName}}<br>
          <b>Age:</b> {{$user->age}}<br>
          <b>About: </b> {{str_limit($user->autobio, 40)}}<br>
        </p>
        <button href="javascript:void(0);" class="btn btn-success accept-friend-request" data-user-id="{{$friend->id}}">Accept Request</button>
        <button href="javascript:void(0);" class="btn btn-danger remove-friend-request" data-user-id="{{$friend->id}}">Deny</button>
      </div>
    </div>
  </div>
  @endforeach
  </div>
  <div class="row">
  </div>
</div>
<script>
  $(".accept-friend-request").on('click', function(){
    var userID = $(this).data('user-id'),
    parentContainer = $(this).closest('.col-md-3.mb-4');
    $.ajax({
      'url' : "{{ route('user-friend.update',0) }}",
      'method' : 'PUT',
      data: { user_id: userID, _token: token },
      success: function(data){
        parentContainer.hide(500);
        alert(data.message);
      },
      error: function(data){
        alert("Failed to accept the friend request.");
        alert(data.message);
      }

    });
  });

  $(".remove-friend-request").on('click', function(){
    var userID = $(this).data('user-id'),
    parentContainer = $(this).closest('.col-md-3.mb-4');
    $.ajax({
      'url' : "{{ route('user-friend.destroy',0) }}",
      'method' : 'DELETE',
      data: { user_id: userID, _token: token },
      success: function(data){
        parentContainer.hide(500);
        alert(data.message);
      },
      error: function(data){
        alert(data.message);
      }

});
});

</script>
@endsection
