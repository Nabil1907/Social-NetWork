<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Custom\AdminFacade;
class HomeAdminController extends Controller
{
    public function  index(){
    return view('admin.dashboard');
    }
    public function show(){
    return view('admin.add_admin');
    }
    public function add(Request $data){

        $data->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dob' => ['date'],
            'gender' => ['required', 'in:M,F'],
            'country' => ['required', 'string'],
            'website' => ['nullable', 'string'],
            'profile_photo' => ['nullable', 'string'],
            'autobio' => ['string']
        ]);

        $admin = new User;

        $adminFacade = new AdminFacade($admin);
        $adminFacade->createAdmin();


        return view('admin.dashboard');

    }

}
