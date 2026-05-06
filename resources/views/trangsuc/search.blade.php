@extends('trangsuc.layout')

@section('css')
<style>
    .search-header {
        padding: 150px 5% 50px;
        background: #fdfdfd;
        text-align: center;
    }
    .search-title {
        font-size: 2.5rem;
        color: var(--dark-charcoal);
        margin-bottom: 15px;
        font-family: 'Playfair Display', serif;
    }
    /* Kế thừa lưới sản phẩm */
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
    .search-bar {
        margin: 0 auto 30px;
        max-width: 600px;
        display: flex;
    }
    .search-input {
        flex: 1;
        padding: 15px 20px;
        border: 1px solid #ddd;
        border-radius: 30px 0 0 30px;
        outline: none;
    }
    .search-btn {
        padding: 15px 30px;
        background: var(--dark-charcoal);
        color: #fff;
        border: none;
        border-radius: 0 30px 30px 0;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="search-header">
    <h1 class="search-title">Kết Quả Tìm Kiếm: "{{ $query }}"</h1>
    <form action="{{ route('trangsuc.search') }}" method="GET" class="search-bar">
        <input type="text" name="s" class="search-input" value="{{ $query }}" placeholder="Tìm kiếm trang sức...">
        <button type="submit" class="search-btn"><i class="fa-solid fa-search"></i></button>
    </form>
    <p>Tìm thấy {{ count($products) }} sản phẩm</p>
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
            <p class="product-price">{{ number_format($product->unit_price) }}đ</p>
        </div>
    </div>
    @empty
    <div style="grid-column: 1/-1; text-align: center; padding: 50px;">
        <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa của bạn.</p>
    </div>
    @endforelse
</div>
@endsection
