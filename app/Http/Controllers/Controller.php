<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use App\Follow;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $followNumber = Follow::where('follower', Auth::id())->count();
            $followerNumber = Follow::where('follow', Auth::id())->count();

            View::share('followNumber', $followNumber);
            View::share('followerNumber', $followerNumber);
            return $next($request);
        });
    }
}
