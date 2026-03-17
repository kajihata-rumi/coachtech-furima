@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/index.css') }}">
@endsection

@section('content')
        <div class="mypage">
            <div class="mypage__header">
                <div class="mypage__profile">
                    <div class="mypage__image"></div>
                    <h1 class="mypage__name">{{ $user->name }}</h1>
                </div>

                <div class="mypage__edit">
                    <a href="{{ route('profile.edit') }}" class="mypage__edit-button">プロフィールを編集</a>
                </div>
            </div>

            <div class="mypage__tabs">
                <a href="/mypage?page=sell" class="mypage__tab mypage__tab--active">出品した商品</a>
                <a href="/mypage?page=buy" class="mypage__tab">購入した商品</a>
            </div>

            <div class="mypage__items">
                @for ($i = 0; $i < 4; $i++)
                    <div class="mypage__item">
                        <div class="mypage__item-image"></div>
                        <p class="mypage__item-name">商品名</p>
                    </div>
                @endfor
            </div>
        </div>
@endsection

