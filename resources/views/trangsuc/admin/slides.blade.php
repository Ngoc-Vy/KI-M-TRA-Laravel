@extends('trangsuc.admin.layout')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Quản lý Slides (Banner Trang chủ)</h2>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slides as $slide)
            <tr>
                <td>{{ $slide->id }}</td>
                <td><img src="/source/image/slide/{{ $slide->image }}" width="200" height="80" style="object-fit:cover; border-radius:4px;"></td>
                <td>
                    <a href="{{ route('trangsuc.admin.slides.delete', $slide->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                </td>
            </tr>
            @endforeach
            @if(count($slides) == 0)
            <tr>
                <td colspan="3" style="text-align:center; padding: 30px;">Không có slide nào.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
