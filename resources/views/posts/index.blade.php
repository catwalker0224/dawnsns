@extends('layouts.login')

@section('content')

<div class="tweet-form">
  <p class="user-icon"><img src="images/dawn.png" alt="ユーザーアイコン"></p>
  <form action="post/create" method="post" class="tweet-area">@csrf
    <textarea name="newPost" rows="3" cols="50" required, placeholder='何をつぶやこうか...?'></textarea>
    <button type="submit"><img src="images/post.png" alt="投稿"></button>
  </form>
</div>

<table class='table table-hover'>
  @foreach ($list as $list)
  <tr>
    <td><img src="images/{{ $list->images }}" alt="ユーザーアイコン"></td>
    <td>{{ $list->username }}</td>
    <td>{{ $list->posts }}</td>
    <td>{{ $list->created_at }}</td>
    <td><a class="btn-update" href="/post/{{$list->id}}/update-form"><img src="images/edit.png" alt="更新"></a></td>
    <td><a class="btn-delete" href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="images/trash.png" alt="削除"></a></td>
  </tr>
  @endforeach
</table>


@endsection
