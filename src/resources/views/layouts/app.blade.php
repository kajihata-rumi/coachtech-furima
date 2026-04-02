<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="/">
                    <img src="{{ asset('img/logo.png') }}" alt="COACHTECH">
                </a>
            </div>

            <div class="header__search">
                <form action="/" method="GET">
                    @if (request('tab') === 'mylist')
                        <input type="hidden" name="tab" value="mylist">
                    @endif

                    <input class="header__search_input" type="text" name="keyword" placeholder="なにをお探しですか？"
                        value="{{ request('keyword') }}">
                </form>
            </div>

            <nav class="header__nav">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="header__logout-form">
                        @csrf
                        <button type="submit" class="header__link header__logout-button">ログアウト</button>
                    </form>
                @endauth

                @guest
                    <a class="header__link" href="{{ route('login') }}">
                        ログイン
                    </a>
                @endguest

                <a class="header__link" href="/mypage">
                    マイページ
                </a>

                <a class="header__button" href="/sell">
                    出品
                </a>
            </nav>

        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>