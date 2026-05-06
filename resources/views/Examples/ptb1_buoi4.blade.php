<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải phương trình bậc nhất</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 500px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .radio-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .radio-group div {
            display: flex;
            align-items: center;
        }
        
        .radio-group input[type="radio"] {
            margin-right: 5px;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: bold;
        }
        
        button[type="submit"] {
            background: #667eea;
            color: white;
        }
        
        button[type="submit"]:hover {
            background: #5a67d8;
        }
        
        .reset-btn {
            background: #f56565;
            color: white;
            text-decoration: none;
            text-align: center;
            padding: 12px;
            border-radius: 5px;
            display: block;
        }
        
        .reset-btn:hover {
            background: #e53e3e;
        }
        
        .result-box {
            margin-top: 30px;
            padding: 20px;
            background: #f7fafc;
            border-radius: 5px;
            border-left: 4px solid #667eea;
        }
        
        .result-item {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }
        
        .alert-danger {
            background: #fed7d7;
            border: 1px solid #fc8181;
            color: #c53030;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .error-message {
            color: #e53e3e;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Giải phương trình bậc nhất</h1>
        
        @if ($errors->any())
            <div class="alert-danger">
                <ul style="margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('ptb1_Controller.tinh') }}" method="POST" id="mainForm">
            @csrf
            
            <div class="form-group">
                <label for="a">Hệ số a:</label>
                <input type="text" 
                       id="a" 
                       name="a" 
                       value="{{ old('a') }}" 
                       placeholder="Nhập hệ số a"
                       autofocus>
            </div>
            
            <div class="form-group">
                <label for="b">Hệ số b:</label>
                <input type="text" 
                       id="b" 
                       name="b" 
                       value="{{ old('b') }}" 
                       placeholder="Nhập hệ số b">
            </div>
            
            <div class="form-group">
                <label>Chọn phép tính:</label>
                <div class="radio-group">
                    <div>
                        <input type="radio" 
                               name="pheptinh" 
                               id="cong" 
                               value="cong" 
                               {{ old('pheptinh') == 'cong' ? 'checked' : '' }}>
                        <label for="cong">Cộng (+)</label>
                    </div>
                    
                    <div>
                        <input type="radio" 
                               name="pheptinh" 
                               id="tru" 
                               value="tru"
                               {{ old('pheptinh') == 'tru' ? 'checked' : '' }}>
                        <label for="tru">Trừ (-)</label>
                    </div>
                    
                    <div>
                        <input type="radio" 
                               name="pheptinh" 
                               id="nhan" 
                               value="nhan"
                               {{ old('pheptinh') == 'nhan' ? 'checked' : '' }}>
                        <label for="nhan">Nhân (×)</label>
                    </div>
                    
                    <div>
                        <input type="radio" 
                               name="pheptinh" 
                               id="chia" 
                               value="chia"
                               {{ old('pheptinh') == 'chia' ? 'checked' : '' }}>
                        <label for="chia">Chia (÷)</label>
                    </div>
                </div>
            </div>
            
            <div class="button-group">
                <button type="submit">Tính</button>
                <a href="{{ route('ptb1_Controller.reset') }}" class="reset-btn">Reset</a>
            </div>
        </form>
        
        @if(session('ketqua') || session('ketqua2'))
            <div class="result-box">
                <h3 style="margin-bottom: 10px; color: #4a5568;">Kết quả:</h3>
                
                @if(session('ketqua'))
                    <div class="result-item">
                        <strong>Phương trình:</strong> {{ session('ketqua') }}
                    </div>
                @endif
                
                @if(session('ketqua2'))
                    <div class="result-item">
                        <strong>Phép tính:</strong> {{ session('ketqua2') }}
                    </div>
                @endif
            </div>
        @endif
    </div>
    
    <script>
        // Focus vào ô a khi load trang
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('a').focus();
        });
    </script>
</body>
</html>