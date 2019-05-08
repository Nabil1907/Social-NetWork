<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\Page;
use Illuminate\Http\Request;
class searchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = $request->input('q');
        if(!$query)

            return redirect()->route('home');

        $users = User::where('name' , 'LIKE' , "%{$query}%")
                       ->orWhere('email' , 'LIKE' , "%{$query}%")
                       ->get();
        $pages = Page::where('page_name' , 'LIKE' , "%{$query}%")
                       ->get();
        return view('search.results' , compact('users' , 'pages'));
    }

}
