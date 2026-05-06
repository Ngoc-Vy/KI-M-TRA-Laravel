<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cập Nhật Trạng Thái Đơn Hàng</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #d4af37;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: #d4af37;
            color: #fff;
            border-radius: 20px;
            font-weight: 600;
            margin: 20px 0;
        }
        .details {
            margin-bottom: 30px;
        }
        .details p {
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 40px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #121212;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LUMIÈRE</h1>
            <p>Jewelry & Excellence</p>
        </div>
        
        <h2>Xin chào,</h2>
        <p>Chúng tôi xin thông báo rằng trạng thái đơn hàng <strong>#{{ $bill->id }}</strong> của bạn đã được cập nhật.</p>
        
        <div style="text-align: center;">
            <div class="status-badge">
                {{ $bill->status }}
            </div>
        </div>
        
        <div class="details">
            <p><strong>Ngày đặt hàng:</strong> {{ $bill->date_order }}</p>
            <p><strong>Tổng cộng:</strong> {{ number_format($bill->total) }} VNĐ</p>
            <p><strong>Hình thức thanh toán:</strong> {{ $bill->payment }}</p>
        </div>
        
        <p>Cảm ơn bạn đã tin tưởng và lựa chọn sản phẩm của chúng tôi. Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với bộ phận chăm sóc khách hàng.</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="btn">Quay lại cửa hàng</a>
        </div>
        
        <div class="footer">
            <p>&copy; 2026 LUMIÈRE Jewelry. All rights reserved.</p>
            <p>Địa chỉ: 123 Luxury Street, Jewelry District</p>
        </div>
    </div>
</body>
</html>
