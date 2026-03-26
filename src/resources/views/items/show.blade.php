@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('content')
    @php
        $itemName = data_get($item, 'name', '');
        $brandName = data_get($item, 'brand_name', '') ?: data_get($item, 'brand', '');
        $price = data_get($item, 'price', 0);
        $description = data_get($item, 'description', '');
        $imagePath = data_get($item, 'image', '');

        $conditionName =
            data_get($item, 'condition.name')
            ?? data_get($item, 'condition.condition')
            ?? data_get($item, 'condition.content')
            ?? data_get($item, 'condition_name')
            ?? data_get($item, 'item_condition')
            ?? data_get($item, 'condition')
            ?? '';

        $rawCategories =
            data_get($item, 'categories')
            ?? data_get($item, 'itemCategories')
            ?? data_get($item, 'category')
            ?? [];

        $categories = collect($rawCategories)->map(function ($category) {
            if (is_string($category)) {
                return $category;
            }

            return data_get($category, 'name')
                ?? data_get($category, 'content')
                ?? data_get($category, 'category_name')
                ?? data_get($category, 'category')
                ?? data_get($category, 'label')
                ?? '';
        })->filter()->values();

        $comments = collect(data_get($item, 'comments', []));
        $likes = collect(data_get($item, 'likes', []));
        $likesCount = data_get($item, 'likes_count', $likes->count());
        $commentsCount = data_get($item, 'comments_count', $comments->count());
        $isLikedByAuthUser = auth()->check() && $likes->contains('user_id', auth()->id());

        $heartIconUrl = asset('img/icon-heart-default.png');
        $commentIconUrl = asset('img/icon-comment.png');

        $imageUrl = '';
        if ($imagePath) {
            if (\Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://', '/'])) {
                $imageUrl = $imagePath;
            } elseif (\Illuminate\Support\Str::startsWith($imagePath, 'storage/')) {
                $imageUrl = asset($imagePath);
            } else {
                $imageUrl = asset('storage/' . $imagePath);
            }
        }
    @endphp

    <main class="item-detail">
        <div class="item-detail__inner">
            <div class="item-detail__left">
                <div class="item-detail__image-box">
                    @if ($imageUrl)
                        <img src="{{ $imageUrl }}" alt="{{ $itemName }}" class="item-detail__image">
                    @else
                        <div class="item-detail__image-placeholder">商品画像</div>
                    @endif
                </div>
            </div>

            <div class="item-detail__right">
                <section class="item-detail__section item-detail__summary">
                    <h1 class="item-detail__name">{{ $itemName }}</h1>
                    <p class="item-detail__brand">{{ $brandName }}</p>

                    <p class="item-detail__price">
                        ¥{{ number_format($price) }}
                        <span class="item-detail__tax">（税込）</span>
                    </p>

                    <div class="item-detail__meta-icons">
                        <div class="item-detail__meta-item">
                            @auth
                                @if ($isLikedByAuthUser)
                                    <form action="{{ route('like.destroy', $item) }}" method="POST" class="item-detail__like-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item-detail__like-button">
                                            <img src="{{ $heartIconUrl }}" alt="いいね解除" class="item-detail__icon-image">
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('like.store', $item) }}" method="POST" class="item-detail__like-form">
                                        @csrf
                                        <button type="submit" class="item-detail__like-button">
                                            <img src="{{ $heartIconUrl }}" alt="いいね" class="item-detail__icon-image">
                                        </button>
                                    </form>
                                @endif
                            @else
                                <img src="{{ $heartIconUrl }}" alt="いいね" class="item-detail__icon-image">
                            @endauth

                            <span class="item-detail__count">{{ $likesCount }}</span>
                        </div>

                        <div class="item-detail__meta-item">
                            <img src="{{ $commentIconUrl }}" alt="コメント" class="item-detail__icon-image">
                            <span class="item-detail__count">{{ $commentsCount }}</span>
                        </div>
                    </div>

                    <a href="#" class="item-detail__purchase-button">購入手続きへ</a>
                </section>

                <section class="item-detail__section">
                    <h2 class="item-detail__heading">商品説明</h2>

                    <div class="item-detail__description">
                        {!! nl2br(e($description)) !!}
                    </div>
                </section>

                <section class="item-detail__section">
                    <h2 class="item-detail__heading">商品の情報</h2>

                    <div class="item-detail__info-row">
                        <span class="item-detail__info-label">カテゴリー</span>
                        <div class="item-detail__category-list">
                            @forelse ($categories as $categoryName)
                                <span class="item-detail__category-tag">{{ $categoryName }}</span>
                            @empty
                                <span class="item-detail__info-value">未設定</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="item-detail__info-row">
                        <span class="item-detail__info-label">商品の状態</span>
                        <span class="item-detail__info-value">{{ $conditionName ?: '未設定' }}</span>
                    </div>
                </section>

                <section class="item-detail__section">
                    <h2 class="item-detail__heading">コメント({{ $commentsCount }})</h2>

                    <div class="item-detail__comment-list">
                        @forelse ($comments as $comment)
                            <div class="item-detail__comment-item">
                                <div class="item-detail__comment-user">
                                    <div class="item-detail__comment-user-icon"></div>
                                    <span class="item-detail__comment-user-name">
                                        {{ data_get($comment, 'user.name', 'user') }}
                                    </span>
                                </div>

                                <div class="item-detail__comment-body">
                                    {{ data_get($comment, 'content', '') }}
                                </div>
                            </div>
                        @empty
                            <p class="item-detail__no-comment">コメントはまだありません</p>
                        @endforelse
                    </div>
                </section>

                <section class="item-detail__section">
                    <h2 class="item-detail__heading">商品へのコメント</h2>

                    <div class="item-detail__comment-form">
                        <textarea class="item-detail__textarea" name="content" rows="6">{{ old('content') }}</textarea>

                        <button type="button" class="item-detail__comment-button">
                            コメントを送信する
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection