<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\Validator;

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
    // バリデーション
    protected function validator(array $data){
        return Validator::make($data, [
            'username' => 'string|min:4|max:12',
            'mail' => 'string|email|min:4|max:12|unique:users',
            // 'newPassword' => 'string|regex:/^[a-zA-Z0-9]+$/|min:4|max:12|unique:users',
            'bio' => 'string|max:200',
            'iconImage' => 'image|regex:/^[a-zA-Z0-9]+$/',
        ]);
    }
    // マイプロフィール編集用メソッド
    public function update(Request $request){
        $edit_username = $request->input('username');
        $edit_mailAddress = $request->input('mailAddress');
        // $edit_newPassword = $request->input('newPassword');
        $edit_bio = $request->input('bio');
        $edit_iconImage = $request->input('iconImage');
        // if(isset($edit_newPassword)){
        //     $edit_newPassword = User::where('password', Auth::id());
        // }
        User::where('id', Auth::id())->update([
            'username' => $edit_username,
            'mail' => $edit_mailAddress,
            // 'password' => $edit_newPassword,
            'bio' => $edit_bio,
            'images' => $edit_iconImage
        ]);
        // $file_upload = $request->file('iconImage')->store('public/images');
        if($request->isMethod('post')){
            $data = $request->input();
            $val = $this->validator($data);
            if($val->fails()){
                return redirect('users.profile')
                ->withErrors($val)
                ->withInput();
            }
            $this->update($data);
            return redirect('users.profile',['file_upload'=>$file_upload]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
