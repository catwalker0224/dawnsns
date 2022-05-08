<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="/js/script.js"></script>
</head>
<body>
    <header>
        <a href="/top"><img class="header-image" src="/images/main_logo.png" alt="ヘッダーイメージ"></a>
        <p class="username">{{Auth::user()->username}} さん</p>
        <span id="accordion-arrow"></span>
        <div id="accordion-menu">
          <ul>
              <li><a href="/top">HOME</a></li>
              <li><a href="/profile">プロフィール編集</a></li>
              <li><a href="/logout">ログアウト</a></li>
          </ul>
        </div>
      <p class="user-icon"><img src="/storage/images/{{ Auth::user()->images }}" alt="ログインユーザーアイコン"></p>
      </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div class="follows-area">
            <p class="username">{{ Auth::user()->username }}さんの</p>
            <p class="follow">フォロー数</p>
            <p class="follow-number">{{ $followNumber }}名</p>
            <p class="followList-btn"><a href="/follow-list">フォローリスト</a></p>
            <p class="follower">フォロワー数</p>
            <p class="follower-number">{{ $followerNumber }}名</p>
            <p class="followerList-btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="search-btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
