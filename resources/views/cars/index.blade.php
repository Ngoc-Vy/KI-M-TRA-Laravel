<h1>DANH SÁCH XE</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('cars.create') }}"> [ + Thêm xe mới ]</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Tên Model</th>
            <th>Hãng sản xuất</th>
            <th>Ngày sản xuất</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cars as $car)
        <tr>
            <td>{{ $car->id }}</td>
           <td>
        <img src="{{ asset('car_img/' . $car->image) }}" width="100" alt="{{ $car->model }}">
            </td>
            <td>{{ $car->model }}</td>
            <td>{{ $car->mf->mf_name }}</td>
            <td>{{ $car->produced_on }}</td>
            <td>
                <a href="{{ route('cars.edit', $car->id) }}">Sửa</a> | 
                
                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $cars->links() }}
</div>