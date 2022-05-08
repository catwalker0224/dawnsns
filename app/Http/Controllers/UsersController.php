<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
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
// 画像アップロード用メソッド
    // public function uploadImage(Request $request){
    //     $file_name = $request
    //     ->file('iconImage')
    //     ->getClientOriginalName();
    //     $this->validate($request,[
    //         'iconImage' => 'image|SafeFilename',
    //     ]);
    //     if($file_name->isValid([])){
    //     $path = $request
    //     ->file('iconImage')
    //     ->storeAs('public/images',$file_name);
    //     return User::where('id', Auth::id())
    //     ->basename([
    //         'images' => $path
    //     ])
    //     ->save();
    //     }
    //     }
    // バリデーション
    protected function validator(array $data){
        return Validator::make($data, [
            'username' => 'string|min:4|max:12',
            'mail' => 'string|email|min:4|max:12|unique:users',
            // 'password' => 'string|regex:/^[a-zA-Z0-9]+$/|min:4|max:12|unique:users',
            'bio' => 'string|max:200',
        ]);
    }
    // マイプロフィール編集用メソッド①
    public function update(array $data){
        if(isset($data['newPassword'])){
        return User::where('id', Auth::id())
        ->update([
            'username' => $data['username'],
            'mail' => $data['mailAddress'],
            'password' => bcrypt($data['newPassword']),
            'bio' => $data['bio'],
        ]);
    }
    }
    // マイプロフィール編集用メソッド②
    public function editProfile(Request $request){
          if($request->isMethod('post')){
            $data = $request->input();
            $val = $this->validator($data);
            if($val->fails()){
                return redirect('/profile')
                ->withErrors($val)
                ->withInput();
            }
            $this->update($data);

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
