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
    .order-table {
        width: 100%;
        border-collapse: collapse;
    }
    .order-table th, .order-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-block;
    }
    .status-new { background: #fff3cd; color: #856404; }
    .status-shipping { background: #d1ecf1; color: #0c5460; }
    .status-delivered { background: #d4edda; color: #155724; }
    .status-canceled { background: #f8d7da; color: #721c24; }
    
    .details-row {
        background: #fdfdfd;
        display: none;
    }
    .details-row.active {
        display: table-row;
    }
    .btn-view-detail {
        background: none;
        border: 1px solid var(--primary-gold);
        color: var(--primary-gold);
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.85rem;
    }
    .btn-view-detail:hover {
        background: var(--primary-gold);
        color: #fff;
    }
    .detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .detail-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="sidebar">
        <ul>
            <li><a href="{{ route('trangsuc.profile') }}">Thông Tin Tài Khoản</a></li>
            <li><a href="{{ route('trangsuc.order_history') }}" class="active">Lịch Sử Đơn Hàng</a></li>
            <li><a href="{{ route('trangsuc.wishlist') }}">Sản Phẩm Yêu Thích</a></li>
            <li><a href="{{ route('trangsuc.logout') }}">Đăng Xuất</a></li>
        </ul>
    </div>
    
    <div class="content-area">
        <h2 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">Lịch Sử Mua Hàng</h2>
        
        @if(count($orders) > 0)
        <table class="order-table">
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Ngày Đặt</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Chi Tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                @php
                    $statusClass = '';
                    $statusText = $order->status ?? 'Mới';
                    if($statusText == 'Mới') $statusClass = 'status-new';
                    elseif($statusText == 'Đang giao') $statusClass = 'status-shipping';
                    elseif($statusText == 'Đã giao') $statusClass = 'status-delivered';
                    elseif($statusText == 'Đã hủy') $statusClass = 'status-canceled';
                @endphp
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->date_order }}</td>
                    <td style="color: var(--primary-gold); font-weight: 600;">{{ number_format($order->total) }}đ</td>
                    <td><span class="status-badge {{ $statusClass }}">{{ $statusText }}</span></td>
                    <td>
                        <button class="btn-view-detail" onclick="toggleDetail({{ $order->id }})">
                            <i class="fa-solid fa-eye"></i> Xem
                        </button>
                    </td>
                </tr>
                <tr class="details-row" id="detail-{{ $order->id }}">
                    <td colspan="5" style="padding: 20px;">
                        <div style="background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #eee;">
                            <h4 style="margin-bottom: 15px; font-size: 0.95rem; border-bottom: 1px solid #eee; padding-bottom: 10px;">Sản phẩm đã mua:</h4>
                            @foreach($order->bill_details as $detail)
                            <div class="detail-item">
                                <img src="/source/image/product/{{ $detail->product->image ?? 'default.jpg' }}" alt="">
                                <div style="flex: 1;">
                                    <div style="font-weight: 500;">{{ $detail->product->name ?? 'Sản phẩm đã xóa' }}</div>
                                    <div style="font-size: 0.85rem; color: #888;">Số lượng: {{ $detail->quantity }} x {{ number_format($detail->unit_price) }}đ</div>
                                </div>
                                <div style="font-weight: 600;">{{ number_format($detail->quantity * $detail->unit_price) }}đ</div>
                            </div>
                            @endforeach
                            <div style="text-align: right; margin-top: 15px; font-weight: 600;">
                                Tổng thanh toán: <span style="color: var(--primary-gold); font-size: 1.1rem;">{{ number_format($order->total) }}đ</span>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <script>
            function toggleDetail(id) {
                const row = document.getElementById('detail-' + id);
                row.classList.toggle('active');
            }
        </script>
        @else
        <div style="padding: 40px; text-align: center; background: #f9f9f9; border-radius: 8px;">
            <p style="color: #888;">Bạn chưa có đơn hàng nào.</p>
        </div>
        @endif
    </div>
</div>
@endsection
