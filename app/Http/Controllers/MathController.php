<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathController extends Controller
{
    /**
     * Hiển thị trang mặc định (phương trình bậc nhất)
     */
    public function index()
    {
        return view('math', ['tab' => 'equation']);
    }

    /**
     * Hiển thị bảng tính
     */
    public function showCalculator()
    {
        return view('math', ['tab' => 'calculator']);
    }

    /**
     * Xử lý giải phương trình bậc nhất
     */
    public function solveEquation(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric'
        ], [
            'a.required' => 'Vui lòng nhập hệ số a',
            'a.numeric' => 'Hệ số a phải là số hợp lệ',
            'b.required' => 'Vui lòng nhập hệ số b',
            'b.numeric' => 'Hệ số b phải là số hợp lệ'
        ]);

        $a = (float) $request->a;
        $b = (float) $request->b;
        
        // Giải phương trình
        if ($a == 0) {
            if ($b == 0) {
                $result = 'Phương trình có vô số nghiệm!';
            } else {
                $result = 'Phương trình vô nghiệm!';
            }
        } else {
            $x = -$b / $a;
            $result = 'Phương trình có nghiệm duy nhất: x = ' . number_format($x, 2);
        }
        
        return redirect()->route('home')
            ->with('equation_result', $result)
            ->with('old_a', $request->a)
            ->with('old_b', $request->b);
    }

    /**
     * Xử lý tính toán
     */
    public function calculate(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric',
            'operation' => 'required|in:+,-,*,/'
        ], [
            'num1.required' => 'Vui lòng nhập số thứ nhất',
            'num1.numeric' => 'Số thứ nhất phải là số hợp lệ',
            'num2.required' => 'Vui lòng nhập số thứ hai',
            'num2.numeric' => 'Số thứ hai phải là số hợp lệ',
            'operation.required' => 'Vui lòng chọn phép tính',
            'operation.in' => 'Phép tính không hợp lệ'
        ]);

        $num1 = (float) $request->num1;
        $num2 = (float) $request->num2;
        $operation = $request->operation;
        
        // Thực hiện phép tính
        $result = null;
        $error = null;
        
        switch ($operation) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    $error = 'Không thể chia cho 0!';
                } else {
                    $result = $num1 / $num2;
                }
                break;
        }
        
        // Format kết quả
        if ($error) {
            return redirect()->route('calculator')
                ->with('calc_error', $error)
                ->with('old_num1', $request->num1)
                ->with('old_num2', $request->num2)
                ->with('old_operation', $request->operation);
        } else {
            $num1_formatted = $this->formatNumber($num1);
            $num2_formatted = $this->formatNumber($num2);
            $result_formatted = $this->formatNumber($result);
            $op_symbol = $this->getOperationSymbol($operation);
            
            $calc_result = "{$num1_formatted} {$op_symbol} {$num2_formatted} = {$result_formatted}";
            
            return redirect()->route('calculator')
                ->with('calc_result', $calc_result)
                ->with('calc_success', true)
                ->with('old_num1', $request->num1)
                ->with('old_num2', $request->num2)
                ->with('old_operation', $request->operation);
        }
    }

    /**
     * Reset bảng tính
     */
    public function resetCalculator()
    {
        return redirect()->route('calculator')
            ->with('reset', true);
    }

    /**
     * Format số (bỏ .0 nếu là số nguyên)
     */
    private function formatNumber($number)
    {
        if ($number == (int)$number) {
            return (int)$number;
        }
        return number_format($number, 2, '.', '');
    }

    /**
     * Lấy ký hiệu phép tính
     */
    private function getOperationSymbol($operation)
    {
        $symbols = [
            '+' => '+',
            '-' => '-',
            '*' => '×',
            '/' => '÷'
        ];
        return $symbols[$operation] ?? $operation;
    }
}