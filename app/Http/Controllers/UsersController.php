<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    // search.blade
    public function search(){
        return view('users.search');
    }
    public function keywordSearch(Request $request){
        $keyword = $request->input('keyword');
        $query = User::query();
        if(isset($keyword)){
            $query->where('username', 'like', '%'.$keyword.'%')
            ->select('users.id', 'users.username', 'users.images');
            $results = $query->get();
            return view('users.search',['results'=>$results]);
        }
    }

    public function profile(){
        return view('users.profile');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
