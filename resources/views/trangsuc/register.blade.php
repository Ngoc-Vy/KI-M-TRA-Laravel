@extends('trangsuc.layout')

@section('css')
<style>
    .auth-container {
        padding: 150px 5% 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        background: #fdfdfd;
    }
    .auth-box {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        width: 100%;
        max-width: 450px;
    }
    .auth-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 30px;
        color: var(--dark-charcoal);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: 'Inter', sans-serif;
        background: #f9f9f9;
    }
    .btn-auth {
        width: 100%;
        background: var(--primary-gold);
        color: #fff;
        padding: 14px;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-auth:hover {
        background: #bfa136;
    }
    .auth-links {
        text-align: center;
        margin-top: 20px;
        font-size: 0.9rem;
    }
    .auth-links a {
        color: var(--primary-gold);
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-box">
        <h2 class="auth-title">Đăng Ký Thành Viên</h2>
        <form action="{{ route('trangsuc.postregister') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Họ và Tên" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email của bạn" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required minlength="6">
            </div>
            <button type="submit" class="btn-auth">Đăng Ký</button>
        </form>
        <div class="auth-links">
            <p>Đã có tài khoản? <a href="{{ route('trangsuc.login') }}">Đăng nhập</a></p>
        </div>
    </div>
</div>
@endsection
