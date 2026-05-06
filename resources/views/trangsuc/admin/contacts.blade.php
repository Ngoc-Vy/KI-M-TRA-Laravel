@extends('trangsuc.admin.layout')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Danh sách Liên hệ / Phản hồi</h2>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thông tin Khách hàng</th>
                <th>Nội dung</th>
                <th>Ngày gửi</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $c)
            <tr>
                <td>#{{ $c->id }}</td>
                <td>
                    <strong>{{ $c->name }}</strong><br>
                    <span style="font-size: 0.85rem; color: #666;">{{ $c->email }}</span>
                </td>
                <td>
                    <div style="max-width: 300px; font-size: 0.9rem;">
                        {{ $c->message }}
                    </div>
                </td>
                <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($c->status == 'chưa liên hệ')
                        <span class="badge badge-warning">Chưa phản hồi</span>
                    @else
                        <span class="badge badge-success">Đã phản hồi</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-primary" onclick="showReplyModal({{ $c->id }}, '{{ $c->name }}', '{{ $c->message }}')" title="Phản hồi">
                        <i class="fa-solid fa-reply"></i>
                    </button>
                    <a href="{{ route('trangsuc.admin.contacts.delete', $c->id) }}" class="btn btn-danger" onclick="return confirm('Xóa liên hệ này?')" title="Xóa">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            @if($c->admin_reply)
            <tr style="background: #fdfdfd;">
                <td colspan="2"></td>
                <td colspan="4">
                    <div style="padding: 10px; border-left: 3px solid #D4AF37; font-size: 0.85rem; color: #555;">
                        <i class="fa-solid fa-comment-dots"></i> <strong>Admin phản hồi:</strong><br>
                        {{ $c->admin_reply }}
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $contacts->links() }}
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" style="display:none; position:fixed; z-index:10001; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
    <div style="background:#fff; width:500px; margin:100px auto; padding:20px; border-radius:8px; position:relative;">
        <span onclick="closeReplyModal()" style="position:absolute; right:20px; top:15px; cursor:pointer; font-size:1.5rem;">&times;</span>
        <h3 id="modalTitle">Phản hồi liên hệ</h3>
        <hr style="margin: 15px 0;">
        
        <p style="font-size: 0.9rem; margin-bottom: 10px;"><strong>Khách hàng:</strong> <span id="modalName"></span></p>
        <p style="font-size: 0.9rem; margin-bottom: 15px; color: #666; font-style: italic;">"<span id="modalMessage"></span>"</p>

        <form id="replyForm" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px;">Nội dung phản hồi:</label>
                <textarea name="reply" style="width:100%; height:150px; padding:10px; border:1px solid #ddd; border-radius:4px;" required></textarea>
            </div>
            <div style="text-align:right;">
                <button type="button" class="btn" onclick="closeReplyModal()" style="background:#888; margin-right:10px;">Hủy</button>
                <button type="submit" class="btn btn-gold">Gửi Phản Hồi</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showReplyModal(id, name, message) {
        document.getElementById('modalName').innerText = name;
        document.getElementById('modalMessage').innerText = message;
        document.getElementById('replyForm').action = '/trangsuc/admin/contacts/reply/' + id;
        document.getElementById('replyModal').style.display = 'block';
    }

    function closeReplyModal() {
        document.getElementById('replyModal').style.display = 'none';
    }
</script>
@endsection
