<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FoodController;
// Route::get('hello',function(){
//     return view('hello');
// });

//buổi 1
// Route::get('/hello1', [HelloController::class,'show']);

//buổi 2
// use App\Http\Controllers\MathController;
// use PhpParser\Node\Expr\FuncCall;
// Route::get('/ptb1',  [MathController::class, 'index']);
// Route::post('/ptb1', [MathController::class, 'solve']);

//buổi3
// use App\Http\Controllers\MathController;
// Route::get('/ptb1-buoi3', [MathController::class,'formBuoi3']);
// Route::post('/ptb1-buoi3', [MathController::class,'solveBuoi3']);


//buổi 4
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ptb1_Controller;
// Route::get('/', [ptb1_Controller::class, 'index'])->name('ptb1_buoi4.index');
// Route::post('/tinh', [ptb1_Controller::class, 'tinh'])->name('ptb1_buoi4.tinh');
// Route::get('/reset', [ptb1_Controller::class, 'reset'])->name('ptb1_buoi4.reset');



/*
|--------------------------------------------------------------------------
| Route Buổi 6,7,8, 9: Quản lý Xe
|--------------------------------------------------------------------------
*/

//Route::get('/', function () {
//    return view('welcome');
//});

// Đây là dòng quan trọng nhất:
//Route::resource('cars', CarController::class);

/*
|--------------------------------------------------------------------------
| Kiểm tra 
|--------------------------------------------------------------------------
*/
// Route hiển thị danh sách (Câu 6)
Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');

// Route hiển thị form thêm (Câu 5)
Route::get('/foods/create', [FoodController::class, 'create'])->name('foods.create');

// Route xử lý lưu dữ liệu
Route::post('/foods/store', [FoodController::class, 'store'])->name('foods.store');
Route::get('/foods/{id}', [App\Http\Controllers\FoodController::class, 'show'])->name('foods.show');


/*
|--------------------------------------------------------------------------
| Web bán hàng 
|--------------------------------------------------------------------------
*/
//route xem giao diện bán hàng
Route::get('index',function(){
    return view('banhang.index');
});

Route::get('product-detail',function(){
    return view('banhang.product-detail');
});
Route::get('checkout',function(){
    return view('banhang.checkout');
});