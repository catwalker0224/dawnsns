@extends('layouts.login')

@section('content')

<div class="tweet-form">
  <p class="user-icon"><img src="images/dawn.png" alt="ユーザーアイコン"></p>
  {!! Form::open(['url' => 'post/top']) !!}
  <p class="tweet-text">
    {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '何をつぶやこうか...?']) !!}
  </p>
  <button type="submit"><img src="images/post.png" alt="投稿"></button>
  {!! Form::close() !!}
</div>

@endsection
