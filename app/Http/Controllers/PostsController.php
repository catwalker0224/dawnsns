<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\Follow;

class PostsController extends Controller
{
    public function index(){
        $lists = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->leftJoin('follows', 'posts.user_id', '=', 'follows.follow')
            ->groupBy('posts.id')
            ->where('users.id', Auth::id())
            ->orWhere('follows.follower', Auth::id())
            ->select('posts.id', 'posts.user_id', 'posts.posts', 'posts.created_at', 'users.username', 'users.images')
            ->orderBy('posts.created_at', 'desc')
            ->get();
            return view('posts.index',['lists'=>$lists]);
        }

    public function tweet(Request $request){
        $post = $request->input('newPost');
        $validator = Validator::make($request->all(),[
            'newPost' => 'required|string|max:150',
        ]);
        if($validator->fails()){
            return redirect('/top')
            ->withErrors($validator)
            ->withInput();
        }
        Post::create([
            'user_id'=>Auth::id(),
            'posts'=>$post,
            'created_at'=>now()
        ]);
            return redirect('/top');
        }

    public function update(Request $request){
        $id = $request->input('id');
        $update_post = $request->input('updatePost');
        $validator = Validator::make($request->all(),[
            'updatePost' => 'required|string|max:150',
        ]);
        if($validator->fails()){
            return redirect('/top')
            ->withErrors($validator)
            ->withInput();
        }
        Post::where('id', $id)
            ->update([
            'posts' => $update_post,
            'updated_at' => now()
        ]);
            return redirect('/top');
        }

    public function delete($id){
        Post::where('id', $id)
            ->delete();
            return redirect('/top');
        }

// test.blade???????????????
    public function test(){
        $lists = Post::where('user_id', Auth::id())
            ->select('posts.posts')
            ->get();
            return view('posts.test',['lists'=>$lists]);
        }
}
