@extends('layouts.app')

@section('content')
<div class="sell-container">
    <h1>商品の出品</h1>

    <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="image">商品画像</label>
            <input type="file" name="image" id="image">
            @error('image')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <hr>

        <div>
            <h2>商品の詳細</h2>

            <div>
                <p>カテゴリー</p>
                @foreach ($categories as $category)
                    <label>
                        <input
                            type="checkbox"
                            name="category_ids[]"
                            value="{{ $category->id }}"
                            {{ is_array(old('category_ids')) && in_array($category->id, old('category_ids')) ? 'checked' : '' }}
                        >
                        {{ $category->content }}
                    </label>
                @endforeach
                @error('category_ids')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="condition_id">商品の状態</label>
                <select name="condition_id" id="condition_id">
                    <option value="">選択してください</option>
                    @foreach ($conditions as $condition)
                        <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                            {{ $condition->content }}
                        </option>
                    @endforeach
                </select>
                @error('condition_id')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr>

        <div>
            <h2>商品名と説明</h2>

            <div>
                <label for="name">商品名</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="brand_name">ブランド名</label>
                <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}">
                @error('brand_name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description">商品の説明</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price">販売価格</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}">
                @error('price')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit">出品する</button>
    </form>
</div>
@endsection