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
<table>
  @foreach ($results as $result)
  <tr class="result-table">
    <td class="found-userIcon"><img src="images/{{ $result->images }}" alt="ユーザーアイコン"></td>
    <td class="found-username">{{ $result->username }}</td>
    <td class="switch-btn">
      @if(in_array($result->id, array_column($followings, 'follow')))
      <form action="/search/{{$result->id}}/remove" method="post">@csrf
      <button class=remove-btn type="submit" name="remove">フォローをはずす</button>
      </form>
      @elseif( $result->id == Auth::user()->id)
      @else
      <form action="/search/{{$result->id}}/follow" method="post">@csrf
      <button class=follow-btn type="submit" name="follow">フォローする</button>
      </form>
      @endif
    </td>
  </tr>
  @endforeach
</table>

@endsection
