@extends('layouts.login')

@section('content')

<!-- ユーザー情報エリア -->
<table class="userInformation">
  @foreach ($othersProfiles as $othersProfile)
  <tr class="userInformation-area">
  <td class="icon">
    <img src="/storage/images/{{ $othersProfile->images }}" alt="ユーザーアイコン">
  </td>
  <td class="username-area">
    <p class="name">Name</p>
    <p class="username">{{ $othersProfile->username }}</p>
  </td>
  <td class="bio-area">
    <p class="bio">Bio</p>
    <p class="text">{{ $othersProfile->bio }}</p>
  </td>
  <td class="switchButton-area">
  @if(in_array($othersProfile->id, array_column($followings, 'follow')))
  <form action="/profile/{{$othersProfile->id}}/remove" method="post">@csrf
    <button class=profileRemove-btn type="submit" name="remove">フォローをはずす</button>
  </form>
  @else
  <form action="/profile/{{$othersProfile->id}}/follow" method="post">@csrf
    <button class=profileFollow-btn type="submit" name="follow">フォローする</button>
  </form>
  </td>
  @endif
  </tr>
  @endforeach
</table>
<!-- ユーザーつぶやきリストエリア -->
<table class="table-container">
  @foreach ($othersPosts as $othersPost)
  <tr class="posts-table">
    <td class="posted-userIcon">
      <img src="/storage/images/{{ $othersPost->images }}" alt="ユーザーアイコン">
    </td>
    <td class="posted-username">{{ $othersPost->username }}</td>
    <td class="posts">{{ $othersPost->posts }}</td>
    <td class="posted-time">{{ $othersPost->created_at }}</td>
  </tr>
  @endforeach
</table>

@endsection
