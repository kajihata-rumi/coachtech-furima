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

                        @auth
                            @if ($item->likes->contains('user_id', auth()->id()))
                                <form action="{{ route('like.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">いいね解除</button>
                                </form>
                            @else
                                <form action="{{ route('like.store', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit">いいね</button>
                                </form>
                            @endif
                        @endauth
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