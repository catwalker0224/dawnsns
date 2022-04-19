@extends('layouts.login')

@section('content')

<!-- 検索フィールド -->
<div class="search-form">
  <form action="/search" method="post">@csrf
    <input type="text" name="keyword" placeholder="ユーザー名">
    <button class="search-btn" type="submit">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </form>
  @if(isset($keyword))
  <p class="search-word">検索ワード：{{ $keyword }}</p>
  @else
  <p></p>
  @endif
</div>

<!-- 検索結果リスト -->
<table class="search-result">
  @foreach ($results as $result)
  <tr>
    <td class="found-userIcon"><img src="images/{{ $result->images }}" alt="ユーザーアイコン"></td>
    <td class="found-username">{{ $result->username }}</td>
    <td class="switch-btn">
      @if 『$result->id(ユーザーのid)が$followingのfollowの項目にあるか』
      <form action="/search/{{$result->id}}/follow" method="post">@csrf
      <button type="submit" name="follow">フォローする</button>
      </form>
      @else
      <form action="/search/{{$result->id}}/remove" method="post">@csrf
      <button type="submit" name="remove">フォローを外す</button>
      </form>
      @endif
    </td>
  </tr>
  @endforeach
</table>

@endsection
