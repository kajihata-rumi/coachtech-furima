@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/index.css') }}">
@endsection

@section('content')
    <div class="mypage">
        <div class="mypage__header">
            <div class="mypage__profile">
                <div class="mypage__image">
                    @if (!empty($user->image))
                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="mypage__image-img">
                    @endif
                </div>
                <h1 class="mypage__name">{{ $user->name }}</h1>
            </div>

            <div class="mypage__edit">
                <a href="{{ route('profile.edit') }}" class="mypage__edit-button">プロフィールを編集</a>
            </div>
        </div>

        <div class="mypage__tabs">
            <a href="/mypage?page=sell" class="mypage__tab {{ $page === 'sell' ? 'mypage__tab--active' : '' }}">
                出品した商品
            </a>

            <a href="/mypage?page=buy" class="mypage__tab {{ $page === 'buy' ? 'mypage__tab--active' : '' }}">
                購入した商品
            </a>
        </div>


        <div class="mypage__items">
            @forelse ($items as $item)
                <div class="mypage__item">
                    <div class="mypage__item-image">
                        @if (!empty($item->image))
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="mypage__item-image">
                        @endif
                    </div>
                    <p class="mypage__item-name">{{ $item->name }}</p>
                </div>
            @empty
                <p class="mypage__empty">商品がありません</p>
            @endforelse
        </div>
    </div>
@endsection