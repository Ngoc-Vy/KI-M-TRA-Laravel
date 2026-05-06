@extends('trangsuc.layout')

@section('css')
<style>
    .profile-container {
        padding: 150px 5% 80px;
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        gap: 40px;
    }
    .sidebar {
        flex: 1;
        min-width: 250px;
    }
    .content-area {
        flex: 3;
    }
    .sidebar ul {
        list-style: none;
        background: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
    }
    .sidebar ul li a {
        display: block;
        padding: 12px 15px;
        color: var(--dark-charcoal);
        border-bottom: 1px solid #eee;
    }
    .sidebar ul li a:hover, .sidebar ul li a.active {
        color: var(--primary-gold);
        font-weight: 500;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .btn-save {
        background: var(--dark-charcoal);
        color: #fff;
        padding: 12px 30px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-save:hover { background: var(--primary-gold); }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="sidebar">
        <ul>
            <li><a href="{{ route('trangsuc.profile') }}" class="active">Thông Tin Tài Khoản</a></li>
            <li><a href="{{ route('trangsuc.order_history') }}">Lịch Sử Đơn Hàng</a></li>
            <li><a href="{{ route('trangsuc.wishlist') }}">Sản Phẩm Yêu Thích</a></li>
            <li><a href="{{ route('trangsuc.logout') }}">Đăng Xuất</a></li>
        </ul>
    </div>
    
    <div class="content-area">
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">Hồ Sơ Của Bạn</h2>
        @if(session('success'))
            <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
        @endif
        <form action="{{ route('trangsuc.postprofile') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Họ và Tên</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->full_name }}" required>
            </div>
            <div class="form-group">
                <label>Email (Không thể thay đổi)</label>
                <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
            </div>
            <div class="form-group">
                <label>Mật Khẩu Mới (Để trống nếu không đổi)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn-save">Lưu Thay Đổi</button>
        </form>
    </div>
</div>
@endsection
