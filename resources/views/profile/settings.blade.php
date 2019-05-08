@extends('layouts.app')

@section('content')

<div class="container bootstrap snippet">
    <div class="row">
            @if ($message!=null)
            <div class="alert alert-info">{{ $message }}</div>
            @endif
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
    </div>
    <div class="row">
  		<div class="col-sm-9">
            <div class="tab-content">
                    <div class="tab-pane active" id="home">
                            <form class="form" action="{{route('update-profile-data')}}" method="POST" id="registrationForm" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group row">{{--Name --}}
                                        <div class="input-group">

                                                <img @if ( $user->profile_photo!="nophoto.jpg")  src="{{ URL::to('/') }}/uploaded/{{$user->profile_photo}}" 

                                                             @else src="{{ URL::to('/') }}/uploaded/nophoto.jpg"
                                                         @endif                           
                                                         class="avatar img-circle img-thumbnail text-left" alt="avatar">

                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file" style="">
                                                        Browse… <input type="file" id="imgInp" name="photo">
                                                    </span>
                                                </span>
                                                
                                        </div>
                                        {{-- <div class="text-right media-left">
                                                <h6 style="background-color:lavender" class="text-center">Hello "{!! Auth::user()->name; !!} Would like to change Your Photo</h6>
                                                <input type="file" name="Photo" class="text-center center-block file-upload">
                                        </div> --}}
                                </div>
                                                         

                                <div class="form-group">{{--Name --}}

                                    <div class="col-xs-6">
                                           
                                            
                                            <label for="firstname"><h4>Name @if ($errors->has('firstname')) <strong class="text-danger">{{ $errors->first('firstname') }}</strong> @endif</h4></label>
                                        
                                        <input type="text" class="form-control  @if ($errors->has('firstname')) border border-danger @endif" name="firstname" id="firstname" placeholder="first-name" title="enter your first name if any." value="{!!$user->name; !!}">
                                    </div>
                                </div>
                                <div class="form-group">{{--DateofBirth --}}

                                        <div class="col-xs-6">
                                            <label for="email"><h4>Date of Birth @if ($errors->has('dop')) <strong class="text-danger">{{ $errors->first('dop') }}</strong> @endif</h4></label>
                                            <input type="text" value="{!! $user->dob; !!}" class=" form-control {{ $errors->has('dob') ? ' is-invalid' : '' }}  @if ($errors->has('dop')) border border-danger @endif" name="dop" id="email" required>
                                        </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <input id="dob" type="text" class="datepicker form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" required>
    
                                    @if ($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}
                                <div class="form-group">{{--Email --}}

                                        <div class="col-xs-6">
                                            <label for="email"><h4>Email @if ($errors->has('email')) <strong class="text-danger">{{ $errors->first('email') }}</strong>@endif</h4></label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email." value="{!! $user->email; !!}">
                                        </div>
                                </div>
                                <div class="form-group">{{--Website --}}

                                        <div class="col-xs-6">
                                            <label for="email"><h4>Website @if ($errors->has('Website')) <strong class="text-danger">{{ $errors->first('Website') }}</strong>@endif</h4></label>
                                            <input type="text" class="form-control" name="Website" id="email" placeholder="your Bio" title="enter your email." value="{!! $user->website; !!}">
                                        </div>
                                </div>

                                <div class="form-group">{{--About --}}

                                        <div class="col-xs-6">
                                            <label for="email"><h4>About you @if ($errors->has('Bio')) <strong class="text-danger">{{ $errors->first('Bio') }}</strong>@endif</h4></label>
                                            <input type="text" class="form-control" name="Bio" id="email" placeholder="your Bio" title="enter your email." value="{!! $user->autobio; !!}">
                                        </div>
                                </div>
                                <div class="form-group">{{--Date ofBirth --}}

                                        <div class="col-xs-6">
                                            <label for="email"><h4>Country</h4></label>
                                            <select id="country" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                                    <option value="">Select Country</option>
                                                    @foreach(\App\User::getCountries() as $code => $name)
                                                      <option value="{{$code}}" {{($code == 'EG' ? 'selected' : '')}}>{{$name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group">{{--Gender--}}
                                       
                                        <div class="col-xs-6">
                                            <label for="gender" ><h4>Gender</h4></label>
                                            <select id="gender" name="gender" class="form-control" required>
                                              <option value="M">Male</option>
                                              <option value="F">Female</option>
                                            </select>
                                            
                                        </div>

                                    {{--     <div class="col-xs-6">
                                            <label for="email"><h4>Gender</h4></label>
                                            <input type="text" class="form-control" name="Bio" id="email" placeholder="your Bio" title="enter your email." value="{!! Auth::user()->email; !!}">
                                             </div> --}}
                                </div>

                                <div class="form-group">{{--Old password --}}
                                    
                                    <div class="col-xs-6">
                                        <label for="old-password"><h4>Old Password @if ($errors->has('Oldpassword')) <strong class="text-danger">{{ $errors->first('Oldpassword') }} @endif</h4></label>
                                        <input type="password" class="form-control" name='Oldpassword'id="old-password" placeholder=" enter old password " title="enter your old password." >
                                    </div> 
                                </div>

                                <div class="form-group">{{--New password --}}

                                    <div class="col-xs-6">
                                        <label for="new-password"><h4>New Password  @if ($errors->has('NewPassword')) <strong class="text-danger">{{ $errors->first('NewPassword') }} @endif</h4></label>
                                        <input type="password" class="form-control" name="NewPassword" id="password" placeholder="enter new password" title="enter your new password." >
                                    </div>
                                </div>

                                <div class="form-group"> {{-- save button --}}
                                    <div class="col-xs-6">
                                            <br>
                                            <br>
                                            <button class="btn btn-lg btn-succcess btn btn-light" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                            {{-- <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button> --}}
                                    </div>
                                </div>
                            </form>
                            <hr>
                    </div><!--/tab-pane-->

            </div><!--/col-9-->
        </div>
    </div>
</div>
@endsection
