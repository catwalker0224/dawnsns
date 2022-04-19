<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    // search.blade
    // 検索用メソッド
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $query = User::query();
        if(isset($keyword)){
            $query->where('username', 'like', '%'.$keyword.'%');
        }
        $results = $query->select('users.id', 'users.username', 'users.images')->get();
            return view('users.search',['results'=>$results, 'keyword'=>$keyword]);
    }
    // フォロー用メソッド
    public function follow($id){
        Follow::insert(['follow'=>$id, 'follower'=>Auth::id()]);
        return redirect('/search');
    }
    // リムーブ用メソッド
    public function remove($id){
        Follow::where('follow.id', ['id'=>$id])
        ->delete();
        return redirect('/search');
    }

    public function profile(){
        return view('users.profile');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
