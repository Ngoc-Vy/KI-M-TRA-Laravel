<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ptb1_Controller extends Controller
{
    // Hiển thị form
    public function index()
    {
        return view('ptb1_buoi4');
    }

    // Xử lý giải phương trình bậc nhất và tính toán
    public function tinh(Request $request)
    {
        // Validation dữ liệu
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ], [
            'a.required' => 'Vui lòng nhập hệ số a',
            'a.numeric' => 'Hệ số a phải là số',
            'b.required' => 'Vui lòng nhập hệ số b',
            'b.numeric' => 'Hệ số b phải là số',
        ]);

        $a = $request->a;
        $b = $request->b;
        $pheptinh = $request->pheptinh;
        $ketqua = '';
        $ketqua2 = '';

        // Giải phương trình bậc nhất
        if ($a == 0) {
            if ($b == 0) {
                $ketqua = "Phương trình có vô số nghiệm";
            } else {
                $ketqua = "Phương trình vô nghiệm";
            }
        } else {
            $x = -$b / $a;
            $x = round($x, 2);
            $ketqua = "Nghiệm x = " . $x;
        }

        // Tính toán theo phép tính được chọn
        switch ($pheptinh) {
            case 'cong':
                $kq = $a + $b;
                $ketqua2 = "Kết quả: " . $a . " + " . $b . " = " . round($kq, 2);
                break;
            case 'tru':
                $kq = $a - $b;
                $ketqua2 = "Kết quả: " . $a . " - " . $b . " = " . round($kq, 2);
                break;
            case 'nhan':
                $kq = $a * $b;
                $ketqua2 = "Kết quả: " . $a . " × " . $b . " = " . round($kq, 2);
                break;
            case 'chia':
                if ($b == 0) {
                    $ketqua2 = "Lỗi: Không thể chia cho 0";
                } else {
                    $kq = $a / $b;
                    $ketqua2 = "Kết quả: " . $a . " ÷ " . $b . " = " . round($kq, 2);
                }
                break;
            default:
                $ketqua2 = "Vui lòng chọn phép tính";
        }

        // Trả về kết quả
        return redirect()->back()
            ->with('ketqua', $ketqua)
            ->with('ketqua2', $ketqua2)
            ->withInput();
    }

    // Reset dữ liệu
    public function reset()
    {
        // Xóa session data
        session()->forget(['ketqua', 'ketqua2', '_old_input']);
        
        return redirect()->route('bac1.index');
    }
}