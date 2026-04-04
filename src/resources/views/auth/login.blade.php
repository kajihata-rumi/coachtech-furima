<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>

<body>
    <div class="auth-page">
        <div class="auth-header">
            <div class="auth-header__logo">COACHTECH</div>
        </div>

        <div class="auth-container">
            <h1 class="auth-title">ログイン</h1>

            @if (session('status'))
                <div class="auth-status">
                    {{ session('status') }}
                </div>
            @endif

            <form class="auth-form" method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="auth-form__group">
                    <label class="auth-form__label" for="email">メールアドレス</label>
                    <input class="auth-form__input" id="email" type="email" name="email" value="{{ old('email') }}"
                        required autofocus>
                    @error('email')
                        <p class="auth__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group">
                    <label class="auth-form__label" for="password">パスワード</label>
                    <input class="auth-form__input" id="password" type="password" name="password" required
                        autocomplete="current-password">
                    @error('password')
                        <p class="auth__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button class="auth-form__button" type="submit">ログインする</button>

                <div class="auth-form__link-wrap">
                    <a class="auth-form__link" href="{{ route('register') }}">会員登録はこちら</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>