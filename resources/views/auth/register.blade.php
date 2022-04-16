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
@if($errors->has('username'))
{{ $errors->first('username') }}
@endif
</div>
<div class="label-mailadress">
{{ Form::label('MailAdress') }}
</div>
<div class="input-mailadress">
{{ Form::text('mail',null,['class' => 'input']) }}
</div>
<div class="label-password">
{{ Form::label('Password') }}
</div>
<div class="input-password">
{{ Form::password('password',null,['class' => 'input']) }}
</div>
<div class="label-password-confirm">
{{ Form::label('Password confirm') }}
</div>
<div class="input-password-confirm">
{{ Form::password('password-confirm',null,['class' => 'input']) }}
</div>
<div class="register-btn">
{{ Form::submit('REGISTER') }}
</div>

<p class=login-link><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
