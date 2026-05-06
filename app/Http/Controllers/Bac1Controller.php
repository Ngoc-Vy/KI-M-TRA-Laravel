<?php
// app/Http/Controllers/Bac1Controller.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Bac1Controller extends Controller
{
    // Hiển thị form
    public function index()
    {
        return view('bac1.index');
    }

    // Xử lý giải phương trình
    public function giai(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ], [
            'a.required' => 'Chưa nhập hệ số a',
            'a.numeric' => 'Hệ số a phải là số',
            'b.required' => 'Chưa nhập hệ số b',
            'b.numeric' => 'Hệ số b phải là số',
        ]);

        // Lấy giá trị từ form
        $a = $request->a;
        $b = $request->b;

        // Giải phương trình
        if ($a == 0) {
            if ($b == 0) {
                $ketqua = "Phương trình có vô số nghiệm";
            } else {
                $ketqua = "Phương trình vô nghiệm";
            }
        } else {
            $x = -$b / $a;
            // Làm tròn 2 số lẻ
            $x = round($x, 2);
            $ketqua = "Nghiệm x = " . $x;
        }

        // Trả về kết quả
        return redirect()->back()
            ->with('ketqua', $ketqua)
            ->withInput(); // Giữ lại dữ liệu đã nhập
    }

    // Xóa dữ liệu
    public function reset()
{
    // Clear toàn bộ session
    session()->flush();
    
    return redirect()->route('bac1.index');
}
}