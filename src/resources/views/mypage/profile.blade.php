@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/profile.css') }}">
@endsection

@section('content')
    <div class="profile">
        <div class="profile__inner">
            <h1 class="profile__title">プロフィール設定</h1>

            <form class="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="profile-image">
                    <div class="profile-image__preview"></div>

                    <div class="profile-image__button-area">
                        <label class="profile-image__button" for="image">画像を選択する</label>
                        <input class="profile-image__input" type="file" id="image" name="image">
                    </div>
                </div>

                <div class="profile-form__group">
                    <label class="profile-form__label" for="name">ユーザー名</label>
                    <input class="profile-form__input" type="text" id="name" name="name"
                        value="{{ old('name', auth()->user()->name) }}">
                </div>

                <div class="profile-form__group">
                    <label class="profile-form__label" for="postal_code">郵便番号</label>
                    <input class="profile-form__input" type="text" id="postal_code" name="postal_code"
                        value="{{ old('postal_code', auth()->user()->postal_code) }}">
                </div>

                <div class="profile-form__group">
                    <label class="profile-form__label" for="address">住所</label>
                    <input class="profile-form__input" type="text" id="address" name="address"
                        value="{{ old('address', auth()->user()->address) }}">
                </div>

                <div class="profile-form__group">
                    <label class="profile-form__label" for="building">建物名</label>
                    <input class="profile-form__input" type="text" id="building" name="building"
                        value="{{ old('building', auth()->user()->building) }}">
                </div>

                <div class="profile-form__button">
                    <button class="profile-form__submit" type="submit">更新する</button>
                </div>
            </form>
        </div>
    </div>
@endsection