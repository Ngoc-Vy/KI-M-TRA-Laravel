@extends('trangsuc.layout')

@section('css')
<style>
    .detail-section {
        padding: 120px 5% 80px;
        background: #fff;
    }
    .product-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
    }
    .product-image-container {
        flex: 1;
        min-width: 400px;
    }
    .product-image-container img {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .product-details {
        flex: 1;
        min-width: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .breadcrumb {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gray-text);
        margin-bottom: 20px;
    }
    .breadcrumb a:hover {
        color: var(--primary-gold);
    }
    .detail-title {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: var(--dark-charcoal);
    }
    .detail-price {
        font-size: 1.5rem;
        color: var(--primary-gold);
        font-weight: 600;
        margin-bottom: 30px;
    }
    .detail-price del {
        color: var(--gray-text);
        font-size: 1.1rem;
        margin-right: 15px;
        font-weight: 400;
    }
    .detail-description {
        color: #555;
        line-height: 1.8;
        margin-bottom: 40px;
        font-weight: 300;
    }
    .action-group {
        display: flex;
        gap: 20px;
    }
    .btn-dark {
        background: var(--dark-charcoal);
        color: #fff;
        padding: 15px 40px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-dark:hover {
        background: var(--primary-gold);
    }
    .btn-outline {
        border: 1px solid var(--dark-charcoal);
        color: var(--dark-charcoal);
        padding: 15px 20px;
        border-radius: 4px;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-outline:hover {
        border-color: var(--primary-gold);
        color: var(--primary-gold);
    }
</style>
@endsection

@section('content')
<div class="detail-section">
    <div class="product-wrapper">
        <div class="product-image-container">
            <img src="/source/image/product/{{ $product->image }}" onerror="this.src='https://images.unsplash.com/photo-1601121141461-9d6647bca1ed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" alt="{{ $product->name }}">
        </div>
        
        <div class="product-details">
            <div class="breadcrumb">
                <a href="{{ route('trangsuc.index') }}">Trang chủ</a> / <span>Chi tiết sản phẩm</span>
            </div>
            
            <h1 class="detail-title">{{ $product->name }}</h1>
            
            <div class="detail-price">
                @if($product->promotion_price != 0)
                    <del>{{ number_format($product->unit_price) }} VNĐ</del>
                    {{ number_format($product->promotion_price) }} VNĐ
                @else
                    {{ number_format($product->unit_price) }} VNĐ
                @endif
            </div>
            
            <div class="detail-description">
                {!! $product->description ?? 'Tuyệt tác trang sức được chế tác tỉ mỉ từ những bàn tay nghệ nhân hàng đầu. Sản phẩm tôn vinh vẻ đẹp sang trọng, đẳng cấp và thanh lịch của người sở hữu. Đây không chỉ là một món trang sức, mà là một tác phẩm nghệ thuật vượt thời gian.' !!}
            </div>
            
            <div class="action-group">
                <a href="{{ route('trangsuc.addtocart', $product->id) }}" class="btn-dark"><i class="fa-solid fa-cart-shopping"></i> Thêm Vào Giỏ</a>
                <a href="{{ route('trangsuc.addtowishlist', $product->id) }}" class="btn-outline"><i class="fa-regular fa-heart"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
