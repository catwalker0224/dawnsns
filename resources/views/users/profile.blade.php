@extends('layouts.login')

@section('content')

<!-- プロフィール編集フォーム -->
<img class="loginIcon" src="/storage/images/{{ Auth::user()->images }}" alt="ログインユーザーアイコン">
<form action="/profile" method="post" class="profile-edit" enctype="multipart/form-data">@csrf
  <label class="username">UserName
    <input type="text" name="username" value="{{ Auth::user()->username }}" class="username">
  </label>
  @if ($errors->has('username'))
    <div class="profileAlert">
        <ul>
            @foreach ($errors->get('username') as $message)
                <li class="username">{{ $message }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <br>
  <label class="mail-address">MailAddress
    <input type="email" name="mail" placeholder="{{ Auth::user()->mail }}" class="mail-address">
  </label>
  @if ($errors->has('mail'))
    <div class="profileAlert">
        <ul>
            @foreach ($errors->get('mail') as $message)
                <li class="mail">{{ $message }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <br>
  <label class="password">Password
    <input type="password" name="oldPassword" value="{{ Auth::user()->password }}" class="password" readonly>
  </label><br>
  <label class="new-password">new Password
    <input type="password" name="newPassword" class="new-password">
  </label>
  @if ($errors->has('newPassword'))
    <div class="profileAlert">
        <ul>
            @foreach ($errors->get('newPassword') as $message)
                <li class="password">{{ $message }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <br>
  <label class="bio">Bio
    <input type="text" name="bio" value="{{ Auth::user()->bio }}" class="bio">
  </label>
  @if ($errors->has('bio'))
    <div class="profileAlert">
        <ul>
            @foreach ($errors->get('bio') as $message)
                <li class="bio">{{ $message }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <br>
  <div class="button-area"></div>
  <label class="icon-image">Icon Image
    <div class="file-button">
      <p class="choose-file">ファイルを選択</p>
    </div>
    <input type="file" name="iconImage" class="icon-image">
  </label>
  @if ($errors->has('iconImage'))
    <div class="profileAlert">
        <ul>
            @foreach ($errors->get('iconImage') as $message)
                <li class="iconImage">{{ $message }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <br>
  <button type="submit" class="profile-update">更　新</button>
</form>
@endsection
