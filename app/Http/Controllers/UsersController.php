<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    // profile.blade
    // マイプロフィール表示用メソッド
    public function profile(){
        return view('users.profile');
    }
    // マイプロフィール編集用メソッド
    public function editProfile(Request $request){
          if($request->isMethod('post')){
            $data = $request->input();
            $own_mail = Auth::user()->mail;
            $validator = Validator::make($request->all(), [
            'username' => ['string', 'min:4', 'max:12',],
            'mail' => ['string', 'email', 'min:4', 'max:12', Rule::unique('users', 'mail')->ignore($own_mail, 'mail')],
            'bio' => ['string', 'max:200'],
        ]);
            if($validator->fails()){
                return redirect('/profile')
                ->withErrors($validator)
                ->withInput();
            }
            User::where('id', Auth::id())
            ->update([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'bio' => $data['bio'],
        ]);

        $password = $request->input('newPassword');
        if(isset($password)){
            $request->validate([
                'password' => 'string|regex:/^[a-zA-Z0-9]+$/|min:4|max:12|unique:users',
            ]);
            User::where('id', Auth::id())
            ->update([
                'password' => bcrypt($password)
            ]);
        }

        $icon = $request->file('iconImage');
        if(isset($icon)){
            $request->validate([
                'iconImage' => 'image',
            ]);
            $file_name = $icon->getClientOriginalName();
            $path = $icon->storeAs('public/images',$file_name);
            User::where('id', Auth::id())
            ->update([
                'images' => $file_name
            ]);
        }
        return redirect('/profile');
    }
}

    // others.blade
    // ユーザープロフィール表示用メソッド
    public function othersProfile(Request $request, $id){
        $othersProfiles = User::where('users.id', $id)
        ->select('users.id', 'users.username','users.bio', 'users.images')
        ->get();

        $othersPosts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->where('users.id', $id)
        ->select('posts.id', 'posts.user_id', 'posts.posts', 'posts.created_at', 'users.username', 'users.images')
        ->orderBy('posts.created_at', 'desc')
        ->get();

        $followings = Follow::where('follower', Auth::id())
        ->get()
        ->toArray();

        return view('users.others', ['othersProfiles'=>$othersProfiles,'othersPosts'=>$othersPosts,'followings'=>$followings]);
    }

    // プロフィールページのフォロー用メソッド
    public function profileFollow($id){
        Follow::insert(['follow'=>$id, 'follower'=>Auth::id()]);
        return back()->withInput();
    }
    // プロフィールページのリムーブ用メソッド
    public function profileRemove($id){
        Follow::where('follows.follow', ['id'=>$id])
        ->delete();
        return back()->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
