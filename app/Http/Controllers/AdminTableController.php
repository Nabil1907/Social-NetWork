<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use DB ;
class AdminTableController extends Controller
{
    public function index()
    {
        $users = User::all()->where('admin',1);
        $arr = array('users' =>$users);
        return view('admin.admintable',$arr);
    }
    public function delete(Request $request)
    {

        DB::table('users')
        ->where('id',$request->id)
        ->delete();
        return redirect(route('admins-table'));

    }
    public function show(Request $request)
    {   
        $user = DB::table('users')->where('id',$request->id)->first();
        return view('admin.edit_admin_profile',compact('user'));       
    }
    public function edit(Request $request,$id)
    {        
        $message="update";
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
    
            $user = User::find($id);
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
                    return redirect(route('admins-table'));
            }
            elseif($request->input('NewPassword')==null&&!Hash::check($request->input('Oldpassword'),$user->password))
            {       $message='you entered a wrong password  ';
                    return redirect(route('admins-table'));
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
                    return redirect(route('users-table'));
    
    
            }
            elseif($request->input('NewPassword')!=null&&!Hash::check($request->input('Oldpassword'),$user->password))
        {
            $message='Wrong Password';
                    return redirect(route('admins-table')); 
            // return  $request->input();
            // return Redirect::back()->withErrors('OldPassword', 'Wrong Paswword');
        }
        //  return  $request->input();
        //  //return redirect()->back();
         //return array($request->input());
         // Storage::delete('/public/uploaded/');
    }
    
}
