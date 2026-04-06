<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food; // Đảm bảo đã tạo Model Food ở bước trước
use App\Http\Requests\FoodRequest; // Đảm bảo đã tạo Request ở bước 4

class FoodController extends Controller
{
    // Câu 6: Hiển thị dữ liệu theo Category giống layout AT10
    public function index()
    {
        $foods = Food::all();
        // Trả về view index và truyền biến foods sang
        return view('foods.index', compact('foods'));
    }

    // Hiển thị form thêm mới (Câu 5)
    public function create()
    {
        return view('foods.create');
    }

    // Câu 5: Xử lý Lưu dữ liệu vào Table T_food
    public function store(FoodRequest $request)
{
    $data = $request->all();

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // Lưu vào thư mục food_img bạn đã tạo trong public
        $file->move(public_path('food_img'), $fileName);
        
        $data['image'] = $fileName;
    }

    // Thêm dấu gạch chéo ngược ở đầu để chắc chắn tìm thấy class
    \App\Models\Food::create($data);

    return redirect()->route('foods.index')->with('success', 'Thêm thành công!');
}
public function show($id)
{
    $food = \App\Models\Food::findOrFail($id);
    return view('foods.show', compact('food'));
}
}