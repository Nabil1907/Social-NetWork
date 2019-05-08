
<div class="col-md-3 mb-4">
    <div class="card">
    <a href="{{route('user-profile-data' , ['id' => $user->id])}}" >
      <img src="{{asset($user->profile_photo)}}" class="card-img-top" alt="...">
    </a>
      <div class="card-body">
        <h5 class="card-title">{{$user->name}}</h5>
        <p class="card-text">
          <b>Gender: </b> {{$user->genderName}}<br>
          <b>Age:</b> {{$user->age}}<br>
          <b>About: </b> {{str_limit($user->autobio, 40)}}<br>
        </p>
      </div>
    </div>
  </div>
