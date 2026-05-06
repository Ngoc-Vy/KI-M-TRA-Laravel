<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Phản Hồi Liên Hệ</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #d4af37; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { color: #d4af37; margin: 0; letter-spacing: 2px; }
        .original-message { background: #f9f9f9; padding: 15px; border-left: 4px solid #ddd; margin: 20px 0; font-style: italic; }
        .reply-box { margin: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #888; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LUMIÈRE</h1>
            <p>Jewelry & Excellence</p>
        </div>
        
        <p>Xin chào <strong>{{ $contact->name }}</strong>,</p>
        
        <p>Cảm ơn bạn đã liên hệ với LUMIÈRE Jewelry. Đây là phản hồi cho thắc mắc của bạn:</p>
        
        <div class="reply-box">
            {!! nl2br(e($replyContent)) !!}
        </div>
        
        <div class="original-message">
            <p><strong>Tin nhắn của bạn:</strong></p>
            <p>{{ $contact->message }}</p>
        </div>
        
        <p>Nếu bạn có bất kỳ câu hỏi nào khác, vui lòng phản hồi lại email này.</p>
        
        <p>Trân trọng,<br>Đội ngũ hỗ trợ LUMIÈRE</p>
        
        <div class="footer">
            <p>&copy; 2026 LUMIÈRE Jewelry. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
