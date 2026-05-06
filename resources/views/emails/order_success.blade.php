<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        .header { text-align: center; border-bottom: 2px solid #d4af37; padding-bottom: 15px; margin-bottom: 20px; }
        .header h2 { color: #d4af37; margin: 0; }
        .order-info { margin-bottom: 20px; }
        .order-info p { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f9f9f9; }
        .total { font-weight: bold; font-size: 1.2rem; color: #d4af37; text-align: right; margin-top: 10px; }
        .footer { text-align: center; font-size: 0.9rem; color: #777; margin-top: 30px; border-top: 1px solid #ddd; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>LUMIÈRE Jewelry</h2>
            <p>Cảm ơn bạn đã đặt hàng!</p>
        </div>
        
        <div class="order-info">
            <h3>Thông tin đơn hàng #{{ $bill->id }}</h3>
            <p><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($bill->date_order)->format('d/m/Y') }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $bill->payment == 'COD' ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản' }}</p>
        </div>

        <h3>Chi tiết sản phẩm</h3>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>SL</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item['item']['name'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>
                        @if($item['item']['promotion_price'] != 0)
                            {{ number_format($item['item']['promotion_price']) }}đ
                        @else
                            {{ number_format($item['item']['unit_price']) }}đ
                        @endif
                    </td>
                    <td>
                        @if($item['item']['promotion_price'] != 0)
                            {{ number_format($item['item']['promotion_price'] * $item['qty']) }}đ
                        @else
                            {{ number_format($item['item']['unit_price'] * $item['qty']) }}đ
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Tổng cộng: {{ number_format($cart->totalPrice) }} VNĐ
        </div>

        <div class="footer">
            <p>Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email này.</p>
            <p>&copy; 2026 LUMIÈRE Jewelry. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
