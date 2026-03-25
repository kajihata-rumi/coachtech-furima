@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('content')
    <div>
        商品詳細画面
        <p>商品名：{{ $item->name }}</p>
        <p>ブランド名：{{ $item->brand_name ?? 'ブランド名なし' }}</p>
        <p>価格：¥{{ number_format($item->price) }}</p>
        <p>商品説明：{{ $item->description }}</p>
        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
        <p>商品の状態：{{ $item->condition->content }}</p>
        <p>カテゴリー：</p>
        <ul>
            @foreach ($item->categories as $category)
                <li>{{ $category->content }}</li>
            @endforeach
        </ul>
        <p>いいね数：{{ $item->likes->count() }}</p>
        <p>コメント数：{{ $item->comments->count() }}</p>

        @foreach ($item->comments as $comment)
            <p>ユーザー名：{{ $comment->user->name }}</p>
            <p>コメント内容：{{ $comment->content }}</p>
        @endforeach
    </div>
@endsection