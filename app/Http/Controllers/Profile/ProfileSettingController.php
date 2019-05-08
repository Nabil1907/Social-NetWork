<?php

namespace App\Http\Controllers\Profile;
use App\User;
use Auth;
use Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileSettingController extends Controller
{
    public function index()
    {   $user = User::find(Auth::id());
        $message="";
        return view('/profile/settings',compact("user","message"));
    }
    public function updateprofile(Request $request)
    {    $message="update";
         $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'dop' => 'required',
            'Oldpassword'=>'required|max:20|min:8',
            'NewPassword'=>'string|nullable',
            'email'=>'required|email|string|',
            'Website'=>'required|string',
            'Bio'=>'required|string',
            'country'=>'required|string',
            'gender'=>'required|string',
            //'photo'=>'|string',
        ]);

        $user = User::find(Auth::id());
        $fileNameStoreImage = $user->profile_photo ;
        /// cheking if the user uploded new photo  and saving it to file public /uploaded with new name to prevent errors
        if ($request->hasFile('photo')) {

            $filenameWithExtention = $request->file('photo')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameStoreImage = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->move(base_path() . '/public/uploaded/', $fileNameStoreImage);
        }

        if( $request->input('NewPassword')==null && Hash::check($request->input('Oldpassword'),$user->password))
        {       $user->name = $request->input('firstname');
                $user->email =$request->input('email');
                $user->profile_photo = $fileNameStoreImage ;
                $user->dob =$request->input('dop');
                $user->gender =$request->input('gender');
                $user->website =$request->input('Website');
                $user->autobio =$request->input('Bio');
                $user->save();
                $message='Data Is saved Successfully';
                return view('/profile/settings',compact("user","message"));
        }
        elseif($request->input('NewPassword')==null&&!Hash::check($request->input('Oldpassword'),$user->password))
        {       $message='you entered a wrong password  ';
                return view('/profile/settings',compact("user","message"));
            // return view('/profile/settings')->withErrors('OldPassword', 'Wrong Paswword');
            // return Redirect::back()->withErrors('OldPassword', 'Wrong Paswword');
        }
        elseif($request->input('NewPassword')!=null&&Hash::check($request->input('Oldpassword'),$user->password))
        {       $this->validate($request, [
                    'NewPassword'=>'different:Oldpassword|max:20|min:8|string', ]);

                $user->name = $request->input('firstname');
                $user->email =$request->input('email');
                $user->profile_photo = $fileNameStoreImage ;
                $user->dob = $request->input('dop');
                $user->password = Hash::make($request->input('NewPassword'));
                $user->gender =$request->input('gender');
                $user->website =$request->input('Website');
                $user->autobio =$request->input('Bio');
                $user->save();
                $message='password is updated';
                // Session::flash('message', "Data Is saved Successfully");
                // return redirect()->back();
                return view('/profile/settings',compact("user","message") );


        }
        elseif($request->input('NewPassword')!=null&&!Hash::check($request->input('Oldpassword'),$user->password))
    {
        $message='Wrong Password';
                return view('/profile/settings',compact("user","message"));
        // return  $request->input();
        // return Redirect::back()->withErrors('OldPassword', 'Wrong Paswword');
    }
    //  return  $request->input();
    //  //return redirect()->back();
     //return array($request->input());
     // Storage::delete('/public/uploaded/');
    }
}
