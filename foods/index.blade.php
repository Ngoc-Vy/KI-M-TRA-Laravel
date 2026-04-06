<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm Của Chúng Tôi - AT10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; background-color: #fff; }
        .product-title { font-weight: bold; margin: 40px 0; text-align: center; font-size: 2.2rem; color: #222; }
        
        /* CSS TABS: CHỈ ACTIVE MỚI XANH + GẠCH CHÂN, CÒN LẠI ĐEN */
        .nav-tabs-custom { border-bottom: none; margin-bottom: 30px; }
        .nav-tabs-custom .nav-item { margin: 0 15px; }
        .nav-tabs-custom .nav-link { 
            color: #000 !important; /* Mặc định chữ màu đen */
            font-weight: bold; 
            text-transform: uppercase; 
            border: none !important; 
            padding: 10px 5px;
            background: none !important;
            border-bottom: 3px solid transparent !important; 
            transition: 0.2s;
        }

        /* Khi Tab được chọn (Active) */
        .nav-tabs-custom .nav-link.active { 
            color: #78b43d !important; /* Chữ màu xanh lá */
            border-bottom: 3px solid #78b43d !important; /* Gạch chân xanh */
            border-radius: 0;
        }

        /* CARD SẢN PHẨM */
        .product-card { border: none; text-align: center; margin-bottom: 30px; transition: 0.3s; }
        .product-card:hover { transform: translateY(-5px); }
        .product-card a { text-decoration: none; color: inherit; }
        .product-card img { 
            width: 100%; 
            height: 200px; 
            object-fit: contain; 
            margin-bottom: 15px;
        }
        .product-name { text-transform: uppercase; font-size: 0.85rem; color: #555; margin-bottom: 8px; font-weight: 600; }
        .price-new { color: #78b43d; font-weight: bold; font-size: 1.1rem; }
        .price-old { color: #bbb; text-decoration: line-through; font-size: 0.8rem; margin-left: 5px; }

        /* PHẦN NỔI BẬT */
        .featured-section { background-color: #f9f9f9; padding: 60px 0; margin-top: 40px; }
        .btn-detail { 
            background-color: #78b43d; color: white; border-radius: 25px; 
            padding: 10px 35px; border: none; font-weight: bold; margin-top: 15px;
            text-decoration: none; display: inline-block;
        }
        .btn-detail:hover { background-color: #669933; color: white; }
    </style>
</head>
<body>

<div class="container mt-4">
    <h1 class="product-title">Sản Phẩm Của Chúng Tôi</h1>

    <ul class="nav nav-tabs nav-tabs-custom justify-content-center" id="productTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="hoa-qua-tab" data-bs-toggle="tab" data-bs-target="#hoa-qua" type="button">Hoa quả</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="thuc-pham-kho-tab" data-bs-toggle="tab" data-bs-target="#thuc-pham-kho" type="button">Thực phẩm khô</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="rau-huu-co-tab" data-bs-toggle="tab" data-bs-target="#rau-huu-co" type="button">Rau hữu cơ</button>
        </li>
    </ul>

    <div class="tab-content" id="productTabContent">
        
        <div class="tab-pane fade show active" id="hoa-qua" role="tabpanel">
            <div class="row">
                @foreach($foods->where('category', 'Hoa quả') as $item)
                <div class="col-md-3">
                    <div class="card product-card">
                        <a href="{{ route('foods.show', $item->id) }}">
                            <img src="{{ asset('food_img/' . $item->image) }}" onerror="this.src='{{ asset('food_img/nho.png') }}'">
                            <div class="card-body p-0">
                                <h6 class="product-name">{{ $item->name }}</h6>
                                <p><span class="price-new">{{ number_format($item->price) }}đ</span><span class="price-old">15,000đ</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane fade" id="thuc-pham-kho" role="tabpanel">
            <div class="row">
                @foreach($foods->where('category', 'Thực phẩm khô') as $item)
                <div class="col-md-3">
                    <div class="card product-card">
                        <a href="{{ route('foods.show', $item->id) }}">
                            <img src="{{ asset('food_img/' . $item->image) }}" onerror="this.src='{{ asset('food_img/rau.png') }}'">
                            <div class="card-body p-0">
                                <h6 class="product-name">{{ $item->name }}</h6>
                                <p><span class="price-new">{{ number_format($item->price) }}đ</span><span class="price-old">15,000đ</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane fade" id="rau-huu-co" role="tabpanel">
            <div class="row">
                @foreach($foods->where('category', 'Rau hữu cơ') as $item)
                <div class="col-md-3">
                    <div class="card product-card">
                        <a href="{{ route('foods.show', $item->id) }}">
                            <img src="{{ asset('food_img/' . $item->image) }}" onerror="this.src='{{ asset('food_img/rau.png') }}'">
                            <div class="card-body p-0">
                                <h6 class="product-name">{{ $item->name }}</h6>
                                <p><span class="price-new">{{ number_format($item->price) }}đ</span><span class="price-old">15,000đ</span></p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<div class="featured-section">
    <div class="container">
        <h2 class="product-title" style="margin-top: 0;">Sản Phẩm Nổi Bật</h2>
        @php $featured = $foods->where('category', 'sản phẩm nổi bật')->first(); @endphp
        @if($featured)
        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('food_img/' . $featured->image) }}" class="img-fluid" style="max-height: 400px;" onerror="this.src='{{ asset('food_img/duas.png') }}'">
            </div>
            <div class="col-md-6">
                <h2 class="text-uppercase fw-bold" style="font-size: 2.5rem; font-family: serif;">{{ $featured->name }}</h2>
                <div class="my-3">
                    <span class="price-new" style="font-size: 2rem;">{{ number_format($featured->price) }}đ</span>
                    <span class="price-old" style="font-size: 1.2rem;">15,000đ</span>
                </div>
                <p class="text-muted" style="line-height: 1.8;">{{ $featured->description }}</p>
                <a href="{{ route('foods.show', $featured->id) }}" class="btn btn-detail">CHI TIẾT</a>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="container text-center my-5">
    <hr>
    <a href="{{ route('foods.create') }}" class="btn btn-outline-success px-4">Thêm Mới Sản Phẩm (Câu 5)</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>