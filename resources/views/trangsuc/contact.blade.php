@extends('trangsuc.layout')

@section('css')
<style>
    .contact-container {
        padding: 150px 5% 80px;
        max-width: 800px;
        margin: 0 auto;
    }
    .contact-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 10px;
        color: var(--dark-charcoal);
    }
    .contact-desc {
        text-align: center;
        color: var(--gray-text);
        margin-bottom: 40px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: 'Inter', sans-serif;
    }
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }
    .btn-submit {
        background: var(--primary-gold);
        color: #fff;
        padding: 15px 40px;
        border: none;
        border-radius: 4px;
        text-transform: uppercase;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        transition: 0.3s;
    }
    .btn-submit:hover {
        background: #bfa136;
    }
</style>
@endsection

@section('content')
<div class="contact-container">
    <h1 class="contact-title">Liên Hệ Chúng Tôi</h1>
    <p class="contact-desc">Hãy gửi bất kỳ thắc mắc nào, đội ngũ tư vấn viên của LUMIÈRE sẽ phản hồi cho bạn trong thời gian sớm nhất.</p>
    
    @if(session('success'))
        <div style="background: #e6f4ea; color: #1e8e3e; padding: 15px; border-radius: 4px; margin-bottom: 20px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('trangsuc.postcontact') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Tên của bạn *" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email của bạn *" required>
        </div>
        <div class="form-group">
            <textarea name="message" class="form-control" placeholder="Nội dung cần hỗ trợ *" required></textarea>
        </div>
        <button type="submit" class="btn-submit">Gửi Tin Nhắn</button>
    </form>
</div>
@endsection
