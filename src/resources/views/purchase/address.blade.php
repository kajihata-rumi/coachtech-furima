@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase/address.css') }}">
@endsection

@section('content')
    <div class="purchase-address">
        <h1 class="purchase-address__title">住所の変更</h1>

        <form action="{{ route('purchase.address.update', ['item' => $item->id]) }}" method="POST"
            class="purchase-address__form">
            @csrf

            <div class="purchase-address__group">
                <label for="postal_code" class="purchase-address__label">郵便番号</label>
                <input type="text" name="postal_code" id="postal_code"
                    value="{{ old('postal_code', $shipping['postal_code']) }}" class="purchase-address__input">
                @error('postal_code')
                    <p class="purchase-address__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="purchase-address__group">
                <label for="address" class="purchase-address__label">住所</label>
                <input type="text" name="address" id="address" value="{{ old('address', $shipping['address']) }}"
                    class="purchase-address__input">
                @error('address')
                    <p class="purchase-address__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="purchase-address__group">
                <label for="building" class="purchase-address__label">建物名</label>
                <input type="text" name="building" id="building" value="{{ old('building', $shipping['building']) }}"
                    class="purchase-address__input">
                @error('building')
                    <p class="purchase-address__error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="purchase-address__button">更新する</button>
        </form>
    </div>
@endsection