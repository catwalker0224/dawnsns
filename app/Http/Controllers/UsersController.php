<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    // search.blade
    // 検索結果表示用メソッド
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $query = User::query();
        if(isset($keyword)){
            $query->where('username', 'like', '%'.$keyword.'%');
        }
        $results = $query->select('users.id', 'users.username', 'users.images')->get();
        $followNumber = Follow::where('follower', Auth::id())->count();
        $followerNumber = Follow::where('follow', Auth::id())->count();
        $followings = Follow::where('follower', Auth::id())->get()->toArray();
        return view('users.search',['results'=>$results, 'keyword'=>$keyword, 'followings'=>$followings]);
    }
    // フォロー用メソッド
    public function follow($id){
        Follow::insert(['follow'=>$id, 'follower'=>Auth::id()]);
        return redirect('/search');
    }
    // リムーブ用メソッド
    public function remove($id){
        Follow::where('follows.follow', ['id'=>$id])
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
