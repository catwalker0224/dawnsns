@extends('layouts.login')

@section('content')

<!-- プロフィール編集フォーム -->
<img class="loginIcon" src="images/{{ Auth::user()->images }}" alt="ログインユーザーアイコン">
<form action="/profile" method="post" class="profile-edit" enctype="multipart/form-data">@csrf
  <label class="username">UserName
    <input type="text" name="username" value="{{ Auth::user()->username }}" class="username">
  </label><br>
  <label class="mail-address">MailAddress
    <input type="email" name="mailAddress" value="{{ Auth::user()->mail }}" class="mail-address">
  </label><br>
  <label class="password">Password
    <input type="password" name="password" value="{{ Auth::user()->password }}" class="password" readonly>
  </label><br>
  <label class="new-password">new Password
    <input type="password" name="newPassword" class="new-password">
  </label><br>
  <label class="bio">Bio
    <input type="text" name="bio" value="{{ Auth::user()->bio }}" class="bio">
  </label><br>
  <div class="button-area"></div>
  <label class="icon-image">Icon Image
    <div class="file-button">
      <p class="choose-file">ファイルを選択</p>
    </div>
    <input type="file" name="iconImage" class="icon-image">
  </label><br>
  <button type="submit" class="profile-update">更　新</button>
</form>
@endsection
