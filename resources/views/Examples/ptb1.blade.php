<!DOCTYPE html>
<html>
<head>
    <title>Giải PT bậc 1</title>
</head>

<body style="text-align:center;margin-top:80px;">

<h2>Giải phương trình ax + b = 0</h2>

<form method="post" action="/ptb1">
    @csrf

    a: <input type="number" name="a" value="{{ $a ?? '' }}"><br><br>
    b: <input type="number" name="b" value="{{ $b ?? '' }}"><br><br>

    <h3>Chọn phép tính</h3>

    <input type="radio" name="pheptinh" value="cong"> Cộng
    <input type="radio" name="pheptinh" value="tru"> Trừ
    <input type="radio" name="pheptinh" value="nhan"> Nhân
    <input type="radio" name="pheptinh" value="chia"> Chia

    <br><br>

    <button type="submit">Tính</button>

</form>

<br>

@if(isset($ketquaPT))
<h3>Kết quả phương trình: {{ $ketquaPT }}</h3>
@endif

@if(isset($ketquaTinh))
<h3>Kết quả phép tính: {{ $ketquaTinh }}</h3>
@endif

</body>
</html>