@extends('trangsuc.admin.layout')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Quản lý Danh mục (Loại Sản Phẩm)</h2>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên loại</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td><img src="/source/image/product/{{ $cat->image }}" width="50" height="50" style="object-fit:cover; border-radius:4px;"></td>
                <td>
                    <a href="{{ route('trangsuc.admin.categories.delete', $cat->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
