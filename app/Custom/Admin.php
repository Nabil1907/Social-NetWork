<?php

namespace App\Custom;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Admin{
  public function CreateAdmin(){
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'dob' => $data['dob'],
        'gender' => $data['gender'],
        'country' => $data['country'],
        'website' => $data['website'],
        'profile_photo' => (isset($data['profile_photo']) ? $data['profile_photo'] : 'nophoto.jpg' ),
        'autobio' => $data['autobio']
    ]);
  }

  public function setAsAdmin($admin){
    $admin->update(['admin' => 1]);
    return true;
  }


}
