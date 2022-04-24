<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    // followList.blade
    public function followList(){
        $followLists = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('follows', 'follows.follow', '=', 'users.id')
        ->where('follows.follower', Auth::id())
        ->select('posts.user_id', 'posts.posts', 'posts.created_at', 'users.username', 'users.images')
        ->orderBy('posts.created_at', 'desc')
        ->get();
        return view('follows.followList', ['followLists'=>$followLists]);
    }
    public function followerList(){
        return view('follows.followerList');
    }
}
