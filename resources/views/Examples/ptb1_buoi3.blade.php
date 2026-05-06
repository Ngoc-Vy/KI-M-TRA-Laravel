<!DOCTYPE html>
<html>
<head>
<title>Buổi 3 - Giải PT bậc nhất</title>

<style>

body{
font-family:Arial;
background:#eef2f7;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:white;
padding:40px;
width:420px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

h2{
text-align:center;
margin-bottom:20px;
}

input{
width:100%;
padding:10px;
margin-top:5px;
margin-bottom:10px;
}

button{
padding:10px 20px;
border:none;
border-radius:5px;
cursor:pointer;
}

.btn-tinh{
background:#2196F3;
color:white;
}

.btn-reset{
background:#f44336;
color:white;
}

.error{
color:red;
font-size:14px;
}

.result{
margin-top:20px;
font-weight:bold;
text-align:center;
}

</style>

</head>

<body>

<div class="box">

<h2>Giải phương trình ax + b = 0</h2>

<form method="post" action="/ptb1-buoi3">

@csrf

<label>Hệ số a</label>
<input type="text" name="a" id="a" value="{{ old('a',$a ?? '') }}">
<div class="error">@error('a') {{ $message }} @enderror</div>

<label>Hệ số b</label>
<input type="text" name="b" value="{{ old('b',$b ?? '') }}">
<div class="error">@error('b') {{ $message }} @enderror</div>

<br>

<button class="btn-tinh">Tính</button>
<button type="reset" class="btn-reset">Reset</button>

</form>

@if(isset($ketqua))

<div class="result">
Kết quả: {{ $ketqua }}
</div>

@endif

</div>

<script>

document.querySelector(".btn-reset").onclick=function(){
setTimeout(function(){
document.getElementById("a").focus();
},10);
}

</script>

</body>
</html>