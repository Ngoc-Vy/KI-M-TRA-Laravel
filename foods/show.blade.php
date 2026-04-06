<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-detail-img { width: 100%; max-height: 500px; object-fit: contain; }
        .price { color: #78b43d; font-weight: bold; font-size: 2rem; }
        .btn-back { background-color: #78b43d; color: white; border-radius: 25px; padding: 10px 30px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('food_img/' . $food->image) }}" class="product-detail-img" onerror="this.src='{{ asset('food_img/nho.png') }}'">
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('foods.index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">{{ $food->category }}</li>
                </ol>
            </nav>
            <h1 class="display-4 text-uppercase fw-bold">{{ $food->name }}</h1>
            <p class="price">{{ number_format($food->price) }}đ</p>
            <hr>
            <p class="lead text-muted">{{ $food->description }}</p>
            <div class="mt-4">
                <a href="{{ route('foods.index') }}" class="btn btn-back">QUAY LẠI CỬA HÀNG</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>