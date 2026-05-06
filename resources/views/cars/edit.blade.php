<h1>CHỈNH SỬA XE</h1>

<form action="{{ route('cars.update', $car->id) }}" method="POST">
    @csrf
    @method('PUT') <p>Tên Model: <input type="text" name="model" value="{{ $car->model }}" required></p>
    <p>Mô tả: <textarea name="description" required>{{ $car->description }}</textarea></p>
    <p>Ngày sản xuất: <input type="date" name="produced_on" value="{{ $car->produced_on }}" required></p>
    <p>Tên file ảnh: <input type="text" name="image" value="{{ $car->image }}" required></p>
    
    <p>Hãng sản xuất:
        <select name="mf_id">
            @foreach($mfs as $mf)
                <option value="{{ $mf->id }}" {{ $car->mf_id == $mf->id ? 'selected' : '' }}>
                    {{ $mf->mf_name }}
                </option>
            @endforeach
        </select>
    </p>
    
    <button type="submit">Cập nhật</button>
    <a href="{{ route('cars.index') }}">Hủy bỏ</a>
</form>