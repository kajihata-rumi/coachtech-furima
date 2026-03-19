@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection

@section('content')
    <div class="item-index">
        <div class="item-index__tabs">
            <a href="{{ url('/') . '?tab=recommend&keyword=' . request('keyword') }}"
                class="item-index__tab {{ $tab !== 'mylist' ? 'item-index__tab--active' : '' }}">
                おすすめ
            </a>

            <a href="{{ url('/') . '?tab=mylist&keyword=' . request('keyword') }}"
                class="item-index__tab {{ $tab === 'mylist' ? 'item-index__tab--active' : '' }}">
                マイリスト
            </a>
        </div>

        <div class="item-index__content">
            <div class="item-index__list">
                @forelse ($items as $item)
                    <article class="item-card">
                        <div class="item-card__image-wrapper">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="item-card__image">
                        </div>

                        @if ($item->purchase)
                            <span class="item-card__sold">Sold</span>
                        @endif

                        <p class="item-card__name">{{ $item->name }}</p>
                    </article>
                @empty
                    <p class="item-index__empty">商品がありません</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection