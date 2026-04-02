@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('content')
    <div class="verify-email">
        <div class="verify-email__content">
            <p class="verify-email__message">
                登録していただいたメールアドレスに認証メールを送付しました。<br>
                メール認証を完了してください。
            </p>

            <div class="verify-email__button-wrap">
                <a href="http://localhost:8025" target="_blank" rel="noopener noreferrer" class="verify-email__button">
                    認証はこちらから
                </a>
            </div>

            @if (session('status') === 'verification-link-sent')
                <p class="verify-email__status">
                    認証メールを再送しました。
                </p>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="verify-email__resend-form">
                @csrf
                <button type="submit" class="verify-email__resend">
                    認証メールを再送する
                </button>
            </form>
        </div>
    </div>
@endsection