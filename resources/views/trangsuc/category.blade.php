@extends('trangsuc.layout')

@section('css')
<style>
    .category-header {
        padding: 150px 5% 80px;
        background: #fdfdfd;
        text-align: center;
    }
    .category-title {
        font-size: 3rem;
        color: var(--dark-charcoal);
        margin-bottom: 15px;
    }
    .category-desc {
        color: var(--gray-text);
        font-weight: 300;
        max-width: 600px;
        margin: 0 auto;
    }
    /* Kế thừa .product-grid từ layout qua hoặc khai báo lại */
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
</style>
@endsection

@section('content')
<div class="category-header">
    <h1 class="category-title">{{ $category->name }}</h1>
    <p class="category-desc">Khám phá các sản phẩm nổi bật nhất trong bộ sưu tập {{ $category->name }}.</p>
</div>

<div class="product-grid">
    @forelse($products as $product)
    <div class="product-card">
        <div class="img-container">
            <a href="{{ route('trangsuc.detail', $product->id) }}">
                <img src="/source/image/product/{{ $product->image }}" onerror="this.src='https://images.unsplash.com/photo-1596944924616-7b38e7cf9361?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'" alt="{{ $product->name }}" class="product-img">
            </a>
        </div>
        <div class="product-info">
            <a href="{{ route('trangsuc.detail', $product->id) }}"><h3 class="product-name">{{ $product->name }}</h3></a>
            <p class="product-price">
                @if($product->promotion_price != 0)
                    <del style="color: #888; font-weight: 400; margin-right: 10px;">{{ number_format($product->unit_price) }}đ</del>
                    {{ number_format($product->promotion_price) }}đ
                @else
                    {{ number_format($product->unit_price) }}đ
                @endif
            </p>
        </div>
    </div>
    @empty
    <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #888;">
        <p>Chưa có sản phẩm nào trong danh mục này.</p>
    </div>
    @endforelse
</div>

<!-- Pagination (nếu có) -->
<div style="display: flex; justify-content: center; margin-bottom: 50px;">
    {{ $products->links() }}
</div>
@endsection
