<h1>THÊM XE MỚI</h1>

<form action="{{ route('cars.store') }}" method="POST">
    @csrf
    <p>Tên Model: <input type="text" name="model" required></p>
    <p>Mô tả: <textarea name="description" required></textarea></p>
    <p>Ngày sản xuất: <input type="date" name="produced_on" required></p>
    <p>Tên file ảnh (vd: hinh1.png): <input type="text" name="image" required></p>
    
    <p>Hãng sản xuất:
        <select name="mf_id">
            @foreach($mfs as $mf)
                <option value="{{ $mf->id }}">{{ $mf->mf_name }}</option>
            @endforeach
        </select>
    </p>
    
    <button type="submit">Lưu dữ liệu</button>
    <a href="{{ route('cars.index') }}">Quay lại</a>
</form>