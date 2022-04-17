@extends('layouts.login')

@section('content')

<!-- つぶやき投稿フォーム -->
<div class="tweet-form">
  <p class="user-icon"><img src="images/dawn.png" alt="ユーザーアイコン"></p>
  <form action="post/create" method="post" class="tweet-area">@csrf
    <textarea name="newPost" rows="3" cols="50" required, placeholder='何をつぶやこうか...?'></textarea>
    <button type="submit"><img src="images/post.png" alt="投稿"></button>
  </form>
</div>
<!-- つぶやきリストのテーブル -->
<table class="table-container">
  @foreach ($list as $list)
  <tr class="posts-table">
    <td class="posted-userIcon"><img src="images/{{ $list->images }}" alt="ユーザーアイコン"></td>
    <td class="posted-username">{{ $list->username }}</td>
    <td class="posts">{{ $list->posts }}</td>
    <td class="posted-time">{{ $list->created_at }}</td>
    <!-- 投稿編集ボタン -->
    <td class="btn-edit">
      <a href="/post/{{$list->id}}/update" class="modal-open" data-posted="modal{{$list->id}}">
        <img class="edit-btn" src="images/edit.png" alt="編集モーダル展開用ボタン">
      </a>
    </td>
    <!-- 編集モーダルの内容 -->
    <div class="modal-main js-modal" id="modal{{$list->id}}">
      <div class="modal-inner">
        <div class="inner-content">
          <form action="/post/{{$list->id}}/update" method="post" class="update-area">@csrf
            <input type="hidden" name="id" value="{{$list->id}}">
            <input type="text" name="updatePost" required, placeholder="{{$list->posts}}">
            <input class="update-btn" type="image" src="images/edit.png" alt="編集ボタン">
          </form>
        </div>
      </div>
    </div>
    <!-- 投稿削除ボタン -->
    <td class="btn-delete">
      <a href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')">
      <img src="images/trash.png" alt="削除1">
      <img src="images/trash_h.png" alt="削除2">
      </a>
    </td>
  </tr>
  @endforeach
</table>

@endsection
