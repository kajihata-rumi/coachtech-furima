@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase/create.css') }}">
@endsection

@section('content')
    @php
        $itemName = data_get($item, 'name', '');
        $price = data_get($item, 'price', 0);
        $imagePath = data_get($item, 'image', '');

        $postalCode = data_get($shipping, 'postal_code', '');
        $address = data_get($shipping, 'address', '');
        $building = data_get($shipping, 'building', '');

        $paymentMethodLabel = 'コンビニ支払い';

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

    <main class="purchase">
        <div class="purchase__inner">
            <form action="{{ route('purchase.checkout', ['item' => $item->id]) }}" method="POST" class="purchase__form">
                @csrf

                <div class="purchase__left">
                    <section class="purchase__item-card">
                        <div class="purchase__item-image-box">
                            @if ($imageUrl)
                                <img src="{{ $imageUrl }}" alt="{{ $itemName }}" class="purchase__item-image">
                            @else
                                <div class="purchase__item-image-placeholder">商品画像</div>
                            @endif
                        </div>

                        <div class="purchase__item-info">
                            <h1 class="purchase__item-name">{{ $itemName }}</h1>
                            <p class="purchase__item-price">¥{{ number_format($price) }}</p>
                        </div>
                    </section>

                    <section class="purchase__section">
                        <h2 class="purchase__section-title">支払い方法</h2>

                        <div class="purchase__select-wrap">
                            <select class="purchase__select" name="payment_method" id="payment_method">
                                <option value="konbini">コンビニ支払い</option>
                                <option value="card">カード支払い</option>
                            </select>
                        </div>
                    </section>

                    <section class="purchase__section">
                        <div class="purchase__address-header">
                            <h2 class="purchase__section-title">配送先</h2>
                            <a href="{{ route('purchase.address', ['item' => $item->id]) }}" class="purchase__address-link">
                                変更する
                            </a>
                        </div>

                        <div class="purchase__address-body">
                            <p class="purchase__address-postal">
                                〒 {{ $postalCode ?: '未設定' }}
                            </p>

                            <p class="purchase__address-text">
                                {{ $address ?: '住所未設定' }}
                                @if ($building)
                                    {{ $building }}
                                @endif
                            </p>
                        </div>
                    </section>
                </div>

                <div class="purchase__right">
                    <div class="purchase__summary">
                        <div class="purchase__summary-row">
                            <span class="purchase__summary-label">商品代金</span>
                            <span class="purchase__summary-value">¥{{ number_format($price) }}</span>
                        </div>

                        <div class="purchase__summary-row">
                            <span class="purchase__summary-label">支払い方法</span>
                            <span class="purchase__summary-value"
                                id="payment_method_display">{{ $paymentMethodLabel }}</span>
                        </div>
                    </div>

                    <button type="submit" class="purchase__button">購入する</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        const select = document.getElementById('payment_method');
        const display = document.getElementById('payment_method_display');

        function updatePaymentMethod() {
            const paymentLabels = {
                konbini: 'コンビニ支払い',
                card: 'カード支払い'
            };

            display.textContent = paymentLabels[select.value] || 'コンビニ支払い';
        }

        if (select && display) {
            select.addEventListener('change', updatePaymentMethod);
            updatePaymentMethod();
        }
    </script>
@endsection