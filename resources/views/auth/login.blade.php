@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/login.css">

<div class="login-form">
<p class="welcome-message">DAWNのSNSへようこそ</p>
<div class="label-mailadress">
{{ Form::label('MailAdress') }}
</div>
<div class="input-mailadress">
{{ Form::text('mail',null,['class' => 'input']) }}
</div>
<div class="label-password">
{{ Form::label('password') }}
</div>
<div class="input-password">
{{ Form::password('password',['class' => 'input']) }}
</div>
<div class="login-btn">
{{ Form::submit('LOGIN') }}
</div>
<p class="register-link"><a href="/register">新規ユーザーの方はこちら</a></p>
</div>
{!! Form::close() !!}

@endsection
