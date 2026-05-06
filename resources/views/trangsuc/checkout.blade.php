@extends('trangsuc.layout')

@section('css')
<style>
    .checkout-container {
        padding: 120px 5% 80px;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
    }
    .checkout-form {
        flex: 2;
        min-width: 300px;
    }
    .order-summary {
        flex: 1;
        min-width: 300px;
        background: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        height: fit-content;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: 'Inter', sans-serif;
    }
    .section-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        margin-bottom: 20px;
        border-bottom: 2px solid var(--primary-gold);
        display: inline-block;
        padding-bottom: 5px;
    }
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 10px;
    }
    .summary-total {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--primary-gold);
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    .btn-submit {
        width: 100%;
        background: var(--dark-charcoal);
        color: #fff;
        padding: 15px;
        border: none;
        text-transform: uppercase;
        font-weight: 600;
        border-radius: 4px;
        margin-top: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-submit:hover {
        background: var(--primary-gold);
    }
</style>
@endsection

@section('content')
<div class="checkout-container">
    @if(Session::has('cart'))
    <div class="checkout-form">
        <h2 class="section-heading">Thông Tin Thanh Toán</h2>
        <form action="{{ route('trangsuc.postcheckout') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Họ và Tên</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::check() ? Auth::user()->full_name : '' }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
            </div>
            <div class="form-group">
                <label>Điện Thoại</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Địa Chỉ Giao Hàng</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Phương Thức Thanh Toán</label>
                <select name="payment" class="form-control">
                    <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                    <option value="ATM">Chuyển khoản ngân hàng</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Hoàn Tất Đặt Hàng</button>
        </form>
    </div>
    
    <div class="order-summary">
        <h2 class="section-heading" style="font-size: 1.5rem;">Đơn Hàng Của Bạn</h2>
        @foreach(Session('cart')->items as $product)
        <div class="summary-item">
            <span>{{ $product['item']['name'] }} x {{ $product['qty'] }}</span>
            <span>{{ number_format($product['price']) }}đ</span>
        </div>
        @endforeach
        <div class="summary-item">
            <span>Phí vận chuyển</span>
            <span>Miễn phí</span>
        </div>
        <div class="summary-total">
            <span>Tổng cộng</span>
            <span>{{ number_format(Session('cart')->totalPrice) }}đ</span>
        </div>
    </div>
    @else
    <div style="width: 100%; text-align: center; padding: 50px;">
        <p>Giỏ hàng trống.</p>
        <a href="{{ route('trangsuc.index') }}">Quay lại cửa hàng</a>
    </div>
    @endif
</div>
@endsection
