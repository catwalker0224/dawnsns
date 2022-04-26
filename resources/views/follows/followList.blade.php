@extends('layouts.login')

@section('content')

<!-- フォローアカウントアイコンエリア -->
<div class="followIcon">
  <h1>Follow list</h1>
  @foreach ($followImages as $followImage)
  <a href="/profile/{{ $followImage->user_id }}"><img src="images/{{ $followImage->images }}" alt="フォローアカウントアイコン">
  @endforeach
</div>
<!-- フォローアカウントつぶやきリストエリア -->
<table class="table-container">
  @foreach ($followLists as $followList)
  <tr class="posts-table">
    <td class="posted-userIcon"><img src="images/{{ $followList->images }}" alt="フォローアカウントアイコン"></td>
    <td class="posted-username">{{ $followList->username }}</td>
    <td class="posts">{{ $followList->posts }}</td>
    <td class="posted-time">{{ $followList->created_at }}</td>
  </tr>
  @endforeach
</table>

@endsection
