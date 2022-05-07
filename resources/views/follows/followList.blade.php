@extends('layouts.login')

@section('content')

<!-- フォローアカウントアイコンエリア -->
<div class="followIcon">
  <h1>Follow list</h1>
  <div class="followIcon-viewer">
  @foreach ($followImages as $followImage)
  <a href="/profile/{{ $followImage->id }}">
    <img src="/storage/images/{{ $followImage->images }}" alt="フォローアカウントアイコン">
  </a>
  @endforeach
  </div>
</div>
<!-- フォローアカウントつぶやきリストエリア -->
<table class="table-container">
  @foreach ($followLists as $followList)
  <tr class="posts-table">
    <td class="posted-userIcon">
      <a href="/profile/{{ $followList->user_id }}">
        <img src="/storage/images/{{ $followList->images }}" alt="フォローアカウントアイコン">
      </a>
    </td>
    <td class="posted-username">{{ $followList->username }}</td>
    <td class="posts">{{ $followList->posts }}</td>
    <td class="posted-time">{{ $followList->created_at }}</td>
  </tr>
  @endforeach
</table>

@endsection
