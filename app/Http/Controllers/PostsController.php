<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Follow;

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
        $followNumber = Follow::where('follower', Auth::id())->count();
        $followerNumber = Follow::where('follow', Auth::id())->count();
        return view('posts.index',['list'=>$list]);
    }

    public function tweet(Request $request){
        $post = $request->input('newPost');
        Post::insert(['posts'=>$post, 'user_id'=>Auth::id(), 'created_at'=>now()]);
        return redirect('/top');
    }

    public function update(Request $request){
        $id = $request->input('id');
        $update_post = $request->input('updatePost');
        Post::where('id', $id)
        ->update(['posts' => $update_post]);
        return redirect('/top');
    }

    public function delete($id){
        Post::where('posts.id', ['id'=>$id])
        ->delete();
        return redirect('/top');
    }
}
