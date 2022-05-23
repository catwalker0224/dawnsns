@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/login.css">

<div class="login-container">
  <div class="login-form">
    <p class="welcome-message">DAWNのSNSへようこそ</p>
    <div class="label-mailAddress">
      {{ Form::label('MailAddress') }}
    </div>
    <div class="input-mailAddress">
      {{ Form::text('mail',null,['class' => 'input']) }}
      <p class="error-message">
        @if($errors->has('mail'))
        {{ $errors->first('mail') }}
        @endif
      </P>
    </div>
    <div class="label-password">
      {{ Form::label('password') }}
    </div>
    <div class="input-password">
      {{ Form::password('password',['class' => 'input']) }}
      <p class="error-message">
        @if($errors->has('password'))
        {{ $errors->first('password') }}
        @endif
      </p>
    </div>
    <div class="login-btn">
      {{ Form::submit('LOGIN') }}
    </div>
    <p class="register-link"><a href="/register">新規ユーザーの方はこちら</a></p>
  </div>
</div>

{!! Form::close() !!}

@endSection
