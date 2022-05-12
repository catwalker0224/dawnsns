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
        $followImages = Follow::join('users', 'follows.follow', '=', 'users.id')
            ->groupBy('follows.follow')
            ->where('follows.follower', Auth::id())
            ->select('users.id', 'users.images')
            ->orderBy('users.id', 'asc')
            ->get();
            return view('follows.followList', ['followLists'=>$followLists, 'followImages'=>$followImages]);
    }
    public function followerList(){
        $followerLists = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->leftJoin('follows', 'follows.follower', '=', 'users.id')
            ->where('follows.follow', Auth::id())
            ->select('posts.user_id', 'posts.posts', 'posts.created_at', 'users.username', 'users.images')
            ->orderBy('posts.created_at', 'desc')
            ->get();
        $followerImages = Follow::join('users', 'follows.follower', '=', 'users.id')
            ->groupBy('follows.follower')
            ->where('follows.follow', Auth::id())
            ->select('users.id', 'users.images')
            ->orderBy('users.id', 'asc')
            ->get();
            return view('follows.followerList', ['followerLists'=>$followerLists, 'followerImages'=>$followerImages]);
    }
}
