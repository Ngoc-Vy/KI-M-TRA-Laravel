@extends('trangsuc.layout')

@section('css')
<style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        padding: 50px 5%;
    }

    .product-card {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .product-img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .img-container {
        overflow: hidden;
        position: relative;
    }

    .product-info {
        padding: 20px;
        text-align: center;
    }

    .product-category {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gray-text);
        margin-bottom: 5px;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: var(--dark-charcoal);
    }

    .product-price {
        font-weight: 600;
        color: var(--primary-gold);
    }
    
    .product-price del {
        color: var(--gray-text);
        font-weight: 400;
        font-size: 0.9rem;
        margin-right: 10px;
    }

    .hover-actions {
        position: absolute;
        bottom: 120px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 15px;
        opacity: 0;
        transition: opacity 0.3s ease, bottom 0.3s ease;
    }

    .product-card:hover .hover-actions {
        opacity: 1;
        bottom: 130px;
    }

    .action-btn {
        width: 45px;
        height: 45px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark-charcoal);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .action-btn:hover {
        background: var(--primary-gold);
        color: #fff;
    }
    
    .category-section {
        padding: 80px 5%;
        background-color: #fff;
    }
    
    .category-wrapper {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
    }
    
    .category-item {
        text-align: center;
    }
    
    .category-item img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 2px solid transparent;
        transition: 0.3s;
    }
    
    .category-item:hover img {
        border-color: var(--primary-gold);
        padding: 5px;
    }
    
    .badge-new {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--dark-charcoal);
        color: #fff;
        padding: 5px 15px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 10;
    }
    
    /* Pagination Styles */
    .pagination {
        display: flex;
        list-style: none;
        gap: 10px;
        margin: 0;
        padding: 0;
    }
    .pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 50%;
        color: var(--dark-charcoal);
        font-weight: 500;
        transition: 0.3s;
    }
    .pagination .page-item.active .page-link {
        background: var(--primary-gold);
        border-color: var(--primary-gold);
        color: #fff;
    }
    .pagination .page-item .page-link:hover {
        background: var(--primary-gold);
        border-color: var(--primary-gold);
        color: #fff;
    }
    .pagination .page-item.disabled .page-link {
        color: #ccc;
        pointer-events: none;
        background: #f9f9f9;
        border-color: #eee;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Vẻ Đẹp Vĩnh Cửu</h1>
        <p>Khám phá bộ sưu tập trang sức cao cấp mang hơi thở hiện đại và sang trọng.</p>
        <a href="#new-arrivals" class="btn-gold">Khám Phá Ngay</a>
    </div>
</section>

<!-- Danh mục nổi bật -->
<section class="category-section reveal">
    <h2 class="section-title">Danh Mục Nổi Bật</h2>
    <div class="category-wrapper">
        @foreach($categories as $cat)
        <a href="{{ route('trangsuc.category', $cat->id) }}" class="category-item">
            <img src="/source/image/product/{{ $cat->image }}" onerror="this.src='https://images.unsplash.com/photo-1599643478524-fb66f70362f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80'" alt="{{ $cat->name }}">
            <h4 style="font-family: 'Inter', sans-serif; font-weight: 500; text-transform: uppercase; font-size: 0.9rem;">{{ $cat->name }}</h4>
        </a>
        @endforeach
    </div>
</section>

<!-- Hàng Mới Về -->
<section id="new-arrivals" class="reveal" style="padding: 80px 0; background: var(--soft-white);">
    <h2 class="section-title">Bộ Sưu Tập Mới</h2>
    <div class="product-grid">
        @foreach($new_products as $product)
        <div class="product-card">
            @if($product->new == 1)
                <div class="badge-new">Mới</div>
            @endif
            <div class="img-container">
                <a href="{{ route('trangsuc.detail', $product->id) }}">
                    <!-- Thay bằng link ảnh sản phẩm thực tế của bạn -->
                    <img src="/source/image/product/{{ $product->image }}" onerror="this.src='https://images.unsplash.com/photo-1611591437281-460bfbe1220a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'" alt="{{ $product->name }}" class="product-img">
                </a>
                <div class="hover-actions">
                    <a href="{{ route('trangsuc.addtocart', $product->id) }}" class="action-btn" title="Thêm giỏ hàng"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="{{ route('trangsuc.addtowishlist', $product->id) }}" class="action-btn" title="Yêu thích"><i class="fa-regular fa-heart"></i></a>
                    <a href="{{ route('trangsuc.detail', $product->id) }}" class="action-btn" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
            <div class="product-info">
                <p class="product-category">Trang Sức</p>
                <a href="{{ route('trangsuc.detail', $product->id) }}"><h3 class="product-name">{{ $product->name }}</h3></a>
                <p class="product-price">
                    @if($product->promotion_price != 0)
                        <del>{{ number_format($product->unit_price) }}đ</del>
                        {{ number_format($product->promotion_price) }}đ
                    @else
                        {{ number_format($product->unit_price) }}đ
                    @endif
                </p>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Tất Cả Sản Phẩm -->
<section id="all-products" class="reveal" style="padding: 80px 0; background: #fff;">
    <h2 class="section-title">Tất Cả Sản Phẩm</h2>
    <div class="product-grid">
        @foreach($all_products as $product)
        <div class="product-card">
            @if($product->new == 1)
                <div class="badge-new">Mới</div>
            @endif
            @if($product->promotion_price != 0)
                <div class="badge-new" style="background: var(--primary-gold); left: auto; right: 15px;">Sale</div>
            @endif
            <div class="img-container">
                <a href="{{ route('trangsuc.detail', $product->id) }}">
                    <img src="/source/image/product/{{ $product->image }}" onerror="this.src='https://images.unsplash.com/photo-1611591437281-460bfbe1220a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'" alt="{{ $product->name }}" class="product-img">
                </a>
                <div class="hover-actions">
                    <a href="{{ route('trangsuc.addtocart', $product->id) }}" class="action-btn" title="Thêm giỏ hàng"><i class="fa-solid fa-cart-plus"></i></a>
                    <a href="{{ route('trangsuc.addtowishlist', $product->id) }}" class="action-btn" title="Yêu thích"><i class="fa-regular fa-heart"></i></a>
                    <a href="{{ route('trangsuc.detail', $product->id) }}" class="action-btn" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
            <div class="product-info">
                <p class="product-category">Trang Sức</p>
                <a href="{{ route('trangsuc.detail', $product->id) }}"><h3 class="product-name">{{ $product->name }}</h3></a>
                <p class="product-price">
                    @if($product->promotion_price != 0)
                        <del>{{ number_format($product->unit_price) }}đ</del>
                        {{ number_format($product->promotion_price) }}đ
                    @else
                        {{ number_format($product->unit_price) }}đ
                    @endif
                </p>
            </div>
        </div>
        @endforeach
    </div>
    <div style="display: flex; justify-content: center; margin-top: 40px;">
        {{ $all_products->links('pagination::bootstrap-4') }}
    </div>
</section>
@endsection
