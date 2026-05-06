@extends('trangsuc.admin.layout')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Quản lý Đơn hàng</h2>
    </div>

    <!-- TABS -->
    <div class="tabs">
        <a href="{{ route('trangsuc.admin.orders', ['status' => 'Mới']) }}" class="tab-link {{ $status == 'Mới' ? 'active' : '' }}">Đơn Mới ({{ count($newOrders) }})</a>
        <a href="{{ route('trangsuc.admin.orders', ['status' => 'Đang giao']) }}" class="tab-link {{ $status == 'Đang giao' ? 'active' : '' }}">Đang Giao ({{ count($shippingOrders) }})</a>
        <a href="{{ route('trangsuc.admin.orders', ['status' => 'Đã giao']) }}" class="tab-link {{ $status == 'Đã giao' ? 'active' : '' }}">Đã Giao ({{ count($deliveredOrders) }})</a>
        <a href="{{ route('trangsuc.admin.orders', ['status' => 'Đã hủy']) }}" class="tab-link {{ $status == 'Đã hủy' ? 'active' : '' }}">Đã Hủy ({{ count($canceledOrders) }})</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            @foreach($currentOrders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>
                    <strong>{{ $order->customer ? $order->customer->name : 'N/A' }}</strong><br>
                    <small>{{ $order->customer ? $order->customer->phone : '' }}</small>
                </td>
                <td>{{ $order->date_order }}</td>
                <td><strong style="color:var(--primary-gold)">{{ number_format($order->total) }}đ</strong></td>
                <td>
                    <span class="badge {{ $status == 'Mới' ? 'badge-primary' : ($status == 'Đang giao' ? 'badge-warning' : ($status == 'Đã giao' ? 'badge-success' : 'badge-danger')) }}">
                        {{ $order->status ?? 'Mới' }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('trangsuc.admin.orders.update', $order->id) }}" method="POST" style="display:flex; gap:10px;">
                        @csrf
                        <select name="status" style="padding: 5px; border-radius: 4px; border: 1px solid #ddd;">
                            <option value="Mới" {{ $order->status == 'Mới' ? 'selected' : '' }}>Mới</option>
                            <option value="Đang giao" {{ $order->status == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                            <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                            <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                        <button type="submit" class="btn btn-gold btn-sm"><i class="fa-solid fa-save"></i> Lưu</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if(count($currentOrders) == 0)
            <tr>
                <td colspan="6" style="text-align:center; padding: 30px;">Không có đơn hàng nào trong mục này.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
