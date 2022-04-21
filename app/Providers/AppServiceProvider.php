<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
        $data = ['followNumber'=>$followNumber, 'followerNumber'=>$followerNumber];
        // viewに共通データを渡す
        View::share($data);
        return $next($request);});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
