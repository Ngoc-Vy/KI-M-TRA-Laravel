<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Thực Phẩm Mới - AT10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-top: 50px; }
        .form-container { background: white; padding: 30px; border-radius: 15px; shadow: 0 0 10px rgba(0,0,0,0.1); }
        .error-msg { color: red; font-size: 0.9em; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 form-container shadow">
            <h2 class="text-center mb-4" style="color: #78b43d;">THÊM THỰC PHẨM MỚI</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Rất tiếc!</strong> Đã có một số vấn đề với dữ liệu bạn nhập:<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tên thực phẩm:</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Danh mục:</label>
                    <select name="category" class="form-select @error('category') is-invalid @enderror">
                        <option value="">-- Chọn danh mục --</option>
                        <option value="Hoa quả" {{ old('category') == 'Hoa quả' ? 'selected' : '' }}>Hoa quả</option>
                        <option value="thực phẩm hữu cơ" {{ old('category') == 'thực phẩm hữu cơ' ? 'selected' : '' }}>Thực phẩm hữu cơ</option>
                        <option value="thực phẩm khô" {{ old('category') == 'thực phẩm khô' ? 'selected' : '' }}>Thực phẩm khô</option>
                        <option value="sản phẩm nổi bật" {{ old('category') == 'sản phẩm nổi bật' ? 'selected' : '' }}>Sản phẩm nổi bật</option>
                    </select>
                    @error('category') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá (VNĐ):</label>
                    <input type="number" name="price" value="{{ old('price') }}" 
                           class="form-control @error('price') is-invalid @enderror">
                    @error('price') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả chi tiết:</label>
                    <textarea name="description" rows="3" 
                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Hình ảnh sản phẩm:</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Lưu Sản Phẩm</button>
                    <a href="{{ route('foods.index') }}" class="btn btn-outline-secondary">Quay lại danh sách</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>