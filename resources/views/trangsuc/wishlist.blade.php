@extends('trangsuc.layout')

@section('css')
<style>
    .wishlist-header {
        padding: 150px 5% 50px;
        background: #fdfdfd;
        text-align: center;
    }
    .wishlist-title {
        font-size: 2.5rem;
        color: var(--dark-charcoal);
        font-family: 'Playfair Display', serif;
    }
    .wishlist-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 50px;
    }
    .wishlist-table th, .wishlist-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    .wishlist-table th {
        text-transform: uppercase;
        font-size: 0.9rem;
    }
    .wishlist-item-img {
        width: 80px;
        border-radius: 4px;
        vertical-align: middle;
        margin-right: 15px;
    }
    .btn-add-cart {
        background: var(--dark-charcoal);
        color: #fff;
        padding: 8px 15px;
        border-radius: 4px;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    .btn-add-cart:hover {
        background: var(--primary-gold);
    }
    .btn-remove {
        color: #ff4d4d;
        font-size: 1.2rem;
    }
</style>
@endsection

@section('content')
<div class="wishlist-header">
    <h1 class="wishlist-title">Sản Phẩm Yêu Thích</h1>
</div>

<div style="padding: 0 5% 80px; max-width: 1200px; margin: 0 auto;">
    @if(count($wishlists) > 0)
        <table class="wishlist-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Thêm vào giỏ</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlists as $item)
                <tr>
                    <td>
                        <img src="/source/image/product/{{ $item->product->image }}" onerror="this.src='https://images.unsplash.com/photo-1596944924616-7b38e7cf9361?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80'" class="wishlist-item-img">
                        <span style="font-family: 'Playfair Display', serif;">{{ $item->product->name }}</span>
                    </td>
                    <td style="color: var(--primary-gold); font-weight: 600;">
                        @if($item->product->promotion_price != 0)
                            {{ number_format($item->product->promotion_price) }}đ
                        @else
                            {{ number_format($item->product->unit_price) }}đ
                        @endif
                    </td>
                    <td><a href="{{ route('trangsuc.addtocart', $item->product->id) }}" class="btn-add-cart">Thêm <i class="fa-solid fa-cart-plus"></i></a></td>
                    <td><a href="{{ route('trangsuc.delcart', $item->id) }}" class="btn-remove"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 50px 0;">
            <p style="color: #888; font-size: 1.1rem; margin-bottom: 20px;">Bạn chưa có sản phẩm yêu thích nào.</p>
            <a href="{{ route('trangsuc.index') }}" style="color: var(--primary-gold); text-decoration: underline;">Tiếp tục mua sắm</a>
        </div>
    @endif
</div>
@endsection
