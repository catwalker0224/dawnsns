<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
    }
    public function logout(){
        Auth::logout();
        return redirect('/logout');
    }
}
