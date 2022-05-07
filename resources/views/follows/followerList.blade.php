@extends('layouts.login')

@section('content')

<!-- フォロワーアカウントアイコンエリア -->
<div class="followerIcon">
  <h1>Follower list</h1>
  <div class="followerIcon-viewer">
  @foreach ($followerImages as $followerImage)
  <a href="/profile/{{ $followerImage->id }}">
    <img src="/storage/images/{{ $followerImage->images }}" alt="フォロワーアカウントアイコン">
  </a>
  @endforeach
  </div>
</div>
<!-- フォロワーアカウントつぶやきリストエリア -->
<table class="table-container">
  @foreach ($followerLists as $followerList)
  <tr class="posts-table">
    <td class="posted-userIcon">
      <a href="/profile/{{ $followerList->user_id }}">
        <img src="/storage/images/{{ $followerList->images }}" alt="フォロワーアカウントアイコン">
      </a>
    </td>
    <td class="posted-username">{{ $followerList->username }}</td>
    <td class="posts">{{ $followerList->posts }}</td>
    <td class="posted-time">{{ $followerList->created_at }}</td>
  </tr>
  @endforeach
</table>

@endsection
