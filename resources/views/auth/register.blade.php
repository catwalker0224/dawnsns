@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/register.css">

<div class="register-container">
<div class="register-form">
<h2>新規ユーザー登録</h2>
<div class="label-username">
{{ Form::label('UserName') }}
</div>
<div class="input-username">
{{ Form::text('username',null,['class' => 'input']) }}
<p class="error-message">
@if($errors->has('username'))
<tr>
  @foreach($errors->get('username') as $message)
  <td> {{ $message }} </td>
  @endforeach
</tr>
</p>
@endif
</div>
<div class="label-mailAddress">
{{ Form::label('MailAddress') }}
</div>
<div class="input-mailAddress">
{{ Form::text('mail',null,['class' => 'input']) }}
<p class="error-message">
@if($errors->has('mail'))
<tr>
  @foreach($errors->get('mail') as $message)
  <td> {{ $message }} </td>
  @endforeach
</tr>
@endif
</p>
</div>
<div class="label-password">
{{ Form::label('Password') }}
</div>
<div class="input-password">
{{ Form::password('password',null,['class' => 'input']) }}
<p class="error-message">
@if($errors->has('password'))
<tr>
  @foreach($errors->get('password') as $message)
  <td> {{ $message }} </td>
  @endforeach
</tr>
@endif
</p>
</div>
<div class="label-password-confirm">
{{ Form::label('Password confirm') }}
</div>
<div class="input-password-confirm">
{{ Form::password('password-confirm',null,['class' => 'input']) }}
<p class="error-message">
@if($errors->has('password-confirm'))
<tr>
  @foreach($errors->get('password-confirm') as $message)
  <td> {{ $message }} </td>
  @endforeach
</tr>
@endif
</p>
</div>
<div class="register-btn">
{{ Form::submit('REGISTER') }}
</div>

<p class=login-link><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
