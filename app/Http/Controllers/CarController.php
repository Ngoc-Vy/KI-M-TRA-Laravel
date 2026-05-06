<?php

namespace App\Http\Controllers;
use App\Models\Mf;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * // Hiển thị danh sách
     */
    public function index()
    {
        // 1. Lấy dữ liệu xe kèm theo thông tin hãng (mf) 
        // 2. paginate(10) giúp chia trang, mỗi trang hiện 10 xe (vì bạn có 100 xe)
        $cars = Car::with('mf')->paginate(10);

        // 3. Trả về file giao diện index.blade.php nằm trong thư mục cars
        // compact('cars') giúp chuyển biến $cars sang bên giao diện để dùng
        return view('cars.index', compact('cars'));
    }

    /**
     *  Form thêm
     */
    

public function create()
{
    // Lấy tất cả các hãng xe để người dùng chọn trong Form
    $mfs = Mf::all();

    // Trả về view cars/create.blade.php
    return view('cars.create', compact('mfs'));
}

    /**
     * Lưu dữ liệu
     */
   public function store(Request $request)
{
    // 1. Kiểm tra dữ liệu đầu vào (Validation)
    $request->validate([
        'model' => 'required',
        'description' => 'required',
        'produced_on' => 'required|date',
        'image' => 'required',
        'mf_id' => 'required'
    ], [
        // Bạn có thể thêm thông báo tiếng Việt ở đây nếu muốn
        'model.required' => 'Vui lòng nhập tên đời xe!',
    ]);

    // 2. Lưu vào Database (Nhờ có $fillable ở Model Car nên lệnh này mới chạy được)
    Car::create($request->all());

    // 3. Lưu xong thì quay về trang danh sách và hiện thông báo thành công
    return redirect()->route('cars.index')->with('success', 'Thêm xe mới thành công!');
}

    /**
     * Xem chi tiết
     */
    public function show($id)
{
    // Eager load 'mf' để lấy tên hãng sản xuất
    $car = Car::with('mf')->findOrFail($id);
    
    return view('cars.show', compact('car'));
}

    /**
     * Form sửa
     */
    public function edit($id)
{
    // 1. Tìm chiếc xe theo ID, nếu không thấy sẽ báo lỗi 404
    $car = Car::findOrFail($id);

    // 2. Lấy danh sách hãng xe để đổ vào ô chọn (Dropdown)
    $mfs = Mf::all();

    // 3. Trả về view cars/edit.blade.php kèm dữ liệu xe và hãng
    return view('cars.edit', compact('car', 'mfs'));
}

    /**
     * Cập nhật
     */
    public function update(Request $request, $id)
{
    // 1. Tìm đúng chiếc xe cần sửa
    $car = Car::findOrFail($id);

    // 2. Kiểm tra dữ liệu (Giống hàm store)
    $request->validate([
        'description' => 'required',
        'model' => 'required',
        'produced_on' => 'required|date',
        'image' => 'required',
        'mf_id' => 'required'
    ]);

    // 3. Cập nhật dữ liệu mới vào Database
    $car->update($request->all());

    // 4. Quay về trang danh sách với thông báo thành công
    return redirect()->route('cars.index')->with('success', 'Cập nhật xe thành công!');
}

    /**
     * Xoá
     */
    public function destroy($id)
{
    // 1. Tìm xe
    $car = Car::findOrFail($id);

    // 2. Xóa xe khỏi Database
    $car->delete();

    // 3. Quay về trang danh sách
    return redirect()->route('cars.index')->with('success', 'Đã xóa xe thành công!');
}
}
