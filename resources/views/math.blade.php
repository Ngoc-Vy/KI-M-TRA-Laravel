<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chương trình tính toán</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 700px;
            margin: 0 auto;
        }
        
        .tabs {
            display: flex;
            background: white;
            border-radius: 10px 10px 0 0;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .tab {
            flex: 1;
            padding: 15px 20px;
            text-align: center;
            cursor: pointer;
            border: none;
            background: white;
            font-size: 16px;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
        }
        
        .tab:hover {
            background: #f0f0f0;
        }
        
        .tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .content {
            background: white;
            border-radius: 0 0 10px 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-size: 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        input[type="text"].error {
            border-color: #ff4444;
        }
        
        .error-message {
            color: #ff4444;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .operations {
            display: flex;
            gap: 15px;
            margin: 15px 0;
            flex-wrap: wrap;
        }
        
        .operation-item {
            flex: 1;
            min-width: 80px;
        }
        
        .operation-item input[type="radio"] {
            display: none;
        }
        
        .operation-item label {
            display: block;
            padding: 12px;
            text-align: center;
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0;
        }
        
        .operation-item input[type="radio"]:checked + label {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }
        
        .operation-item label:hover {
            background: #e9ecef;
        }
        
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        button {
            flex: 1;
            min-width: 120px;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
        }
        
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        
        .result-box {
            margin-top: 25px;
            padding: 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
        }
        
        .result-success {
            background: #d1fae5;
            color: #065f46;
            border: 2px solid #10b981;
        }
        
        .result-error {
            background: #fee2e2;
            color: #991b1b;
            border: 2px solid #ef4444;
        }
        
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        
        .validation-errors {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #ef4444;
        }
        
        .validation-errors ul {
            margin-left: 20px;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .operations {
                flex-direction: column;
                gap: 10px;
            }
            
            .buttons {
                flex-direction: column;
            }
            
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tab navigation -->
        <div class="tabs">
            <button class="tab {{ $tab == 'equation' ? 'active' : '' }}" 
                    onclick="window.location='{{ route('home') }}'">
                Giải phương trình bậc nhất
            </button>
            <button class="tab {{ $tab == 'calculator' ? 'active' : '' }}" 
                    onclick="window.location='{{ route('calculator') }}'">
                Bảng tính
            </button>
        </div>
        
        <div class="content">
            @if($tab == 'equation')
                <!-- Tab phương trình bậc nhất -->
                <h2>GIẢI PHƯƠNG TRÌNH BẬC NHẤT</h2>
                <p style="text-align: center; margin-bottom: 20px; color: #666;">
                    <strong>Phương trình: ax + b = 0</strong>
                </p>
                
                <!-- Hiển thị kết quả -->
                @if(session('equation_result'))
                    <div class="alert alert-success">
                        {{ session('equation_result') }}
                    </div>
                @endif
                
                <!-- Hiển thị lỗi validation -->
                @if($errors->any())
                    <div class="validation-errors">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('solve.equation') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="a">Hệ số a:</label>
                        <input type="text" 
                               id="a" 
                               name="a" 
                               value="{{ old('a', session('old_a')) }}"
                               placeholder="Nhập hệ số a"
                               class="@error('a') error @enderror">
                        @error('a')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="b">Hệ số b:</label>
                        <input type="text" 
                               id="b" 
                               name="b" 
                               value="{{ old('b', session('old_b')) }}"
                               placeholder="Nhập hệ số b"
                               class="@error('b') error @enderror">
                        @error('b')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="buttons">
                        <button type="submit" class="btn-primary">Giải phương trình</button>
                        <button type="reset" class="btn-secondary" onclick="this.form.reset()">Xóa</button>
                    </div>
                </form>
                
            @else
                <!-- Tab bảng tính -->
                <h2>BẢNG TÍNH CỘNG TRỪ NHÂN CHIA 2 SỐ</h2>
                
                <!-- Hiển thị kết quả tính toán -->
                @if(session('calc_result'))
                    <div class="alert alert-success">
                        <strong>Kết quả:</strong> {{ session('calc_result') }}
                    </div>
                @endif
                
                <!-- Hiển thị lỗi tính toán -->
                @if(session('calc_error'))
                    <div class="alert alert-danger">
                        {{ session('calc_error') }}
                    </div>
                @endif
                
                <!-- Hiển thị lỗi validation -->
                @if($errors->any())
                    <div class="validation-errors">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('calculate') }}" id="calculatorForm">
                    @csrf
                    
                    <div class="form-group">
                        <label for="num1">Số thứ nhất:</label>
                        <input type="text" 
                               id="num1" 
                               name="num1" 
                               value="{{ old('num1', session('old_num1')) }}"
                               placeholder="Nhập số thứ nhất"
                               class="@error('num1') error @enderror"
                               autofocus>
                        @error('num1')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="num2">Số thứ hai:</label>
                        <input type="text" 
                               id="num2" 
                               name="num2" 
                               value="{{ old('num2', session('old_num2')) }}"
                               placeholder="Nhập số thứ hai"
                               class="@error('num2') error @enderror">
                        @error('num2')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Chọn phép tính:</label>
                        <div class="operations">
                            @php
                                $operations = [
                                    '+' => 'Cộng (+)',
                                    '-' => 'Trừ (-)',
                                    '*' => 'Nhân (×)',
                                    '/' => 'Chia (÷)'
                                ];
                            @endphp
                            
                            @foreach($operations as $value => $label)
                                <div class="operation-item">
                                    <input type="radio" 
                                           name="operation" 
                                           id="op_{{ $value }}" 
                                           value="{{ $value }}"
                                           {{ old('operation', session('old_operation')) == $value ? 'checked' : '' }}>
                                    <label for="op_{{ $value }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('operation')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="buttons">
                        <button type="submit" class="btn-success">Tính</button>
                        <button type="button" class="btn-warning" onclick="resetForm()">Reset</button>
                        <button type="button" class="btn-secondary" onclick="clearResult()">Xóa kết quả</button>
                    </div>
                </form>
                
                <!-- Form reset ẩn -->
                <form method="POST" action="{{ route('reset.calculator') }}" id="resetForm" style="display: none;">
                    @csrf
                </form>
            @endif
        </div>
    </div>
    
    <script>
        // Hàm reset form
        function resetForm() {
            document.getElementById('resetForm').submit();
        }
        
        // Hàm xóa kết quả
        function clearResult() {
            window.location.href = '{{ route('calculator') }}?clear=1';
        }
        
        // Tự động ẩn thông báo sau 5 giây
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
        
        // Tự động focus vào ô nhập đầu tiên khi có lỗi
        @if($tab == 'calculator' && $errors->has('num1'))
            document.getElementById('num1').focus();
        @elseif($tab == 'calculator' && !session('old_num1'))
            document.getElementById('num1').focus();
        @elseif($tab == 'equation' && $errors->has('a'))
            document.getElementById('a').focus();
        @endif
        
        // Xử lý clear parameter
        @if(request()->has('clear'))
            // Đã reload trang, không cần làm gì thêm
        @endif
    </script>
</body>
</html>