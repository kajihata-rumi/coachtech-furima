@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/sell.css') }}">
@endsection

@section('content')
    <div class="sell-form">
        <h1 class="sell-form__title">商品の出品</h1>


        <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="sell-form__section">
                <div class="sell-form__group">
                    <label class="sell-form__label">商品画像</label>

                    <div class="sell-form__image-box">
                        <label for="image" class="sell-form__image-button">画像を選択する</label>
                        <input type="file" name="image" id="image" class="sell-form__file-input">
                    </div>

                    @error('image')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="sell-form__section">
                <h2 class="sell-form__section-title">商品の詳細</h2>

                <div class="sell-form__group">
                    <p class="sell-form__label">カテゴリー</p>
                    <div class="sell-form__category-list">
                        @foreach ($categories as $category)
                            <label class="sell-form__category-item">
                                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                    class="sell-form__category-checkbox" {{ is_array(old('category_ids')) && in_array($category->id, old('category_ids')) ? 'checked' : '' }}>
                                <span class="sell-form__category-text">{{ $category->content }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('category_ids')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sell-form__group">
                    <label for="condition_id" class="sell-form__label">商品の状態</label>

                    <div class="sell-form__select-wrap">
                        <select name="condition_id" id="condition_id" class="sell-form__select">
                            <option value="">選択してください</option>
                            @foreach ($conditions as $condition)
                                <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                                    {{ $condition->content }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error('condition_id')
                        <p class="form__error">{{ $message }}</p>
                    @enderror
            </div>
    </div>

    <div class="sell-form__section">
        <h2 class="sell-form__section-title">商品名と説明</h2>

        <div class="sell-form__group">
            <label for="name" class="sell-form__label">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="sell-form__input">
            @error('name')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="sell-form__group">
            <label for="brand_name" class="sell-form__label">ブランド名</label>
            <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}" class="sell-form__input">
            @error('brand_name')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="sell-form__group">
            <label for="description" class="sell-form__label">商品の説明</label>
            <textarea name="description" id="description" class="sell-form__textarea">{{ old('description') }}</textarea>
            @error('description')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="sell-form__group">
            <label for="price" class="sell-form__label">販売価格</label>
            <div class="sell-form__price-wrap">
                <span class="sell-form__price-symbol">￥</span>
                <input type="number" name="price" id="price" value="{{ old('price') }}"
                    class="sell-form__input sell-form__input--price">
            </div>
            @error('price')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="sell-form__button">出品する</button>
    </form>
    </div>
@endsection