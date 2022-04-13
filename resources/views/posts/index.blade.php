@extends('layouts.login')

@section('content')

<div class="tweet-form">
  <p class="user-icon"><img src="images/dawn.png" alt="ユーザーアイコン"></p>
  <form action="post/create" method="post" class="tweet-area">@csrf
    <textarea name="newPost" rows="3" cols="50" required, placeholder='何をつぶやこうか...?'></textarea>
    <button type="submit"><img src="images/post.png" alt="投稿"></button>
  </form>
</div>

<table class="table-container">
  @foreach ($list as $list)
  <tr class="posts-table">
    <td class="posted-userIcon"><img src="images/{{ $list->images }}" alt="ユーザーアイコン"></td>
    <td class="posted-username">{{ $list->username }}</td>
    <td class="posts">{{ $list->posts }}</td>
    <td class="posted-time">{{ $list->created_at }}</td>
    <!-- 投稿編集ボタン -->
    <td class="btn-edit"><a href="" class="modal-open" data-posted="modal{{$list->id}}"><img class="edit-btn" src="images/edit.png" alt="編集モーダル展開用ボタン"></a></td>
    <!-- 編集モーダルの内容 -->
    <div class="modal-main js-modal" id="modal{{$list->id}}">
      <div class="modal-inner">
        <div class="inner-content">
          <p class="update-explain">つぶやいた内容を表示します。<br><br>つぶやきは最大を150文字までとし、それ以上のテキストが入力フォームに打ち込まれた場合は、投稿できないように設定してください。</p>
          <a href="/post/{{$list->id}}/update-form" class="btn-update"><img src="images/edit.png" alt="編集ボタン"></a>
        </div>
      </div>
    </div>
    <!-- 投稿削除ボタン -->
    <td class="btn-delete"><a href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="images/trash.png" alt="削除"></a></td>
  </tr>
  @endforeach
</table>

@endsection
