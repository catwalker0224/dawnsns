<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // ログインしていれば閲覧可能にする制御の定義
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $list = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->where('users.id', Auth::id())
        ->select('posts.id', 'posts.user_id', 'posts.posts', 'posts.created_at', 'users.username', 'users.images')
        ->orderBy('posts.created_at', 'desc')
        ->get();
        return view('posts.index',['list'=>$list]);
    }

    public function tweet(Request $request){
        $post = $request->input('newPost');
        Post::insert(['posts'=>$post, 'user_id'=>Auth::id(), 'created_at'=>now()]);
        return redirect('/top');
    }

    public function delete($id){
        Post::where('posts.id', ['id'=>$id])
        ->delete();
        return redirect('/top');
    }

    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
}
