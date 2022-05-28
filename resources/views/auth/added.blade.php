@extends('layouts.logout')

@section('content')

<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/added.css">

<div class="clear-container">
  <div class="clear">
    <p class="new-username">{{Session::get('username')}}さん</p>
    <p class="welcome-dawnSNS">ようこそ! DAWNSNSへ</p>
    <p class="register-completed">ユーザー登録が完了しました。</p>
    <p class="try-login">さっそく、ログインをしてみましょう。</p>
    <p class="btn"><a href="/login">ログイン画面へ</a></p>
  </div>
</div>

@endSection
