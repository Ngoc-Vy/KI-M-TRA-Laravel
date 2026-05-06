@extends('trangsuc.admin.layout')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Quản lý Sản Phẩm</h2>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên SP</th>
                <th>Hình ảnh</th>
                <th>Giá gốc</th>
                <th>Giá KM</th>
                <th>Tình trạng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $sp)
            <tr>
                <td>{{ $sp->id }}</td>
                <td>{{ $sp->name }}</td>
                <td><img src="/source/image/product/{{ $sp->image }}" width="50" height="50" style="object-fit:cover; border-radius:4px;"></td>
                <td>{{ number_format($sp->unit_price) }}đ</td>
                <td>{{ $sp->promotion_price > 0 ? number_format($sp->promotion_price).'đ' : 'Không KM' }}</td>
                <td>
                    @if($sp->new == 1) <span class="badge badge-success">Mới</span> @endif
                    @if($sp->top == 1) <span class="badge badge-warning">Nổi bật</span> @endif
                </td>
                <td>
                    <a href="{{ route('trangsuc.admin.products.delete', $sp->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
