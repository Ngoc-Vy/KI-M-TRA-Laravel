@extends('trangsuc.admin.layout')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Quản lý Người dùng</h2>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên đầy đủ</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Quyền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    @if($user->level == 1)
                        <span class="badge badge-danger">Admin</span>
                    @else
                        <span class="badge badge-primary">Customer</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('trangsuc.admin.users.delete', $user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
