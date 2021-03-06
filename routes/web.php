<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::group(['middleware' => 'auth'], function () {
  Route::get('/top','Auth\LoginController@login');
});

// トップページ
Route::get('/top','PostsController@index');
Route::post('post/create','PostsController@tweet');
Route::post('post/{id}/update','PostsController@update');
Route::get('post/{id}/delete','PostsController@delete');
Route::get('/logout','Auth\LoginController@logout');

// 検索ページ
Route::get('/search','UsersController@search');
Route::post('/search','UsersController@search');
Route::get('search/{id}/follow','UsersController@follow');
Route::get('search/{id}/remove','UsersController@remove');

// フォローリスト
Route::get('/follow-list','FollowsController@followList');

// フォロワーリスト
Route::get('/follower-list','FollowsController@followerList');

// マイプロフィール編集ページ
Route::get('/profile','UsersController@editProfile');
Route::post('/profile','UsersController@editProfile');

// ユーザープロフィールページ
Route::get('/profile/{id}','UsersController@othersProfile');
Route::get('profile/{id}/follow','UsersController@profileFollow');
Route::get('profile/{id}/remove','UsersController@profileRemove');

// test用
Route::get('/test','PostsController@test');
