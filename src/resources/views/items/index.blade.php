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
                            <a href="{{ route('items.show', ['item_id' => $item->id]) }}" class="item-card__image-link">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                    class="item-card__image">
                            </a>
                        </div>

                        @if ($item->purchase)
                            <span class="item-card__sold">Sold</span>
                        @endif

                        <p class="item-card__name">
                            <a href="{{ route('items.show', ['item_id' => $item->id]) }}" class="item-card__name-link">
                                {{ $item->name }}
                            </a>
                        </p>
                    </article>

                @empty
                    @if (!(auth()->guest() && $tab === 'mylist'))
                        <p class="item-index__empty">商品がありません</p>
                    @endif
                @endforelse
            </div>
        </div>
    </div>
@endsection