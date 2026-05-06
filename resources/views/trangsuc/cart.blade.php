@extends('trangsuc.layout')

@section('css')
<style>
    .page-header {
        padding: 120px 5% 50px;
        background: #fdfdfd;
        text-align: center;
    }
    .page-title {
        font-size: 2.5rem;
        color: var(--dark-charcoal);
        margin-bottom: 10px;
    }
    .cart-container {
        padding: 0 5% 80px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    .cart-table th, .cart-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    .cart-table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }
    .cart-item-img {
        width: 80px;
        border-radius: 4px;
        vertical-align: middle;
        margin-right: 15px;
    }
    .qty-input {
        width: 60px;
        padding: 5px;
        border: 1px solid #ccc;
        text-align: center;
    }
    .btn-update {
        background: transparent;
        border: none;
        color: var(--primary-gold);
        cursor: pointer;
        text-decoration: underline;
    }
    .btn-remove {
        color: #ff4d4d;
    }
    .cart-summary {
        background: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        text-align: right;
    }
    .cart-total {
        font-size: 1.5rem;
        color: var(--dark-charcoal);
        font-weight: 600;
        margin-bottom: 20px;
    }
    .btn-checkout {
        display: inline-block;
        background: var(--primary-gold);
        color: #fff;
        padding: 12px 30px;
        text-transform: uppercase;
        font-weight: 500;
        border-radius: 4px;
    }
    .btn-checkout:hover {
        background: #bfa136;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Giỏ Hàng Của Bạn</h1>
</div>

<div class="cart-container">
    @if(Session::has('cart'))
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach(Session('cart')->items as $product)
                <tr>
                    <td>
                        <img src="/source/image/product/{{ $product['item']['image'] }}" alt="{{ $product['item']['name'] }}" class="cart-item-img">
                        <span style="font-family: 'Playfair Display', serif; font-size: 1.1rem;">{{ $product['item']['name'] }}</span>
                    </td>
                    <td>{{ number_format($product['item']['unit_price']) }}đ</td>
                    <td>
                        <form action="{{ route('trangsuc.updatecart', $product['item']['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="number" name="qty" class="qty-input" value="{{ $product['qty'] }}" min="1">
                            <button type="submit" class="btn-update">Cập nhật</button>
                        </form>
                    </td>
                    <td style="color: var(--primary-gold); font-weight: 600;">{{ number_format($product['price']) }}đ</td>
                    <td><a href="{{ route('trangsuc.delcart', $product['item']['id']) }}" class="btn-remove"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="cart-summary">
            <div class="cart-total">Tổng Cộng: <span style="color: var(--primary-gold);">{{ number_format(Session('cart')->totalPrice) }}đ</span></div>
            <a href="{{ route('trangsuc.checkout') }}" class="btn-checkout">Tiến Hành Thanh Toán</a>
        </div>
    @else
        <div style="text-align: center; padding: 50px 0;">
            <p style="font-size: 1.2rem; color: #888; margin-bottom: 20px;">Giỏ hàng của bạn đang trống.</p>
            <a href="{{ route('trangsuc.index') }}" class="btn-checkout">Tiếp Tục Mua Sắm</a>
        </div>
    @endif
</div>
@endsection
