<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
</head>

<body>
    <div class="auth-page">
        <div class="auth-header">
            <div class="auth-header__logo">COACHTECH</div>
        </div>

        <div class="auth-container">
            <h1 class="auth-title">会員登録</h1>

            <form class="auth-form" method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="auth-form__group">
                    <label class="auth-form__label" for="name">ユーザー名</label>
                    <input class="auth-form__input" id="name" type="text" name="name" value="{{ old('name') }}" required
                        autofocus>
                    @error('name')
                        <p class="auth__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group">
                    <label class="auth-form__label" for="email">メールアドレス</label>
                    <input class="auth-form__input" id="email" type="email" name="email" value="{{ old('email') }}"
                        required>
                    @error('email')
                        <p class="auth__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group">
                    <label class="auth-form__label" for="password">パスワード</label>
                    <input class="auth-form__input" id="password" type="password" name="password" required
                        autocomplete="new-password">
                    @error('password')
                        <p class="auth__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group">
                    <label class="auth-form__label" for="password_confirmation">確認用パスワード</label>
                    <input class="auth-form__input" id="password_confirmation" type="password"
                        name="password_confirmation" required>
                    @error('password_confirmation')
                        <p class="auth__error-message">{{ $message }}</p>
                    @enderror
                </div>
                <button class="auth-form__button" type="submit">登録する</button>
                <div class="auth-form__link-wrap">
                    <a class="auth-form__link" href="{{ route('login') }}">ログインはこちら</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>