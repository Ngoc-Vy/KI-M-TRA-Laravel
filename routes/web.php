<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangSucController;
use App\Http\Controllers\TrangSucAdminController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| ROUTES CHO WEB TRANG SỨC (LUMIÈRE Jewelry)
|--------------------------------------------------------------------------
| Tất cả các route dành cho khách hàng đều được gom nhóm với tiền tố (prefix)
| là 'trangsuc'. Điều này giúp URL hiển thị dạng: website.com/trangsuc/...
*/

Route::prefix('trangsuc')->group(function () {
    // ---- 1. Nhóm Trang chủ & Sản phẩm ----
    Route::get('/', [TrangSucController::class, 'index'])->name('trangsuc.index'); // Hiển thị trang chủ chính
    Route::get('/san-pham/{id}', [TrangSucController::class, 'detail'])->name('trangsuc.detail'); // Xem chi tiết 1 sản phẩm
    Route::get('/danh-muc/{id}', [TrangSucController::class, 'category'])->name('trangsuc.category'); // Xem sản phẩm theo danh mục
    Route::get('/tim-kiem', [TrangSucController::class, 'search'])->name('trangsuc.search'); // Tìm kiếm sản phẩm theo từ khóa
    
    // ---- 2. Nhóm Giỏ hàng & Thanh toán ----
    Route::get('/gio-hang', [TrangSucController::class, 'cart'])->name('trangsuc.cart'); // Hiển thị giỏ hàng
    Route::get('/add-to-cart/{id}', [TrangSucController::class, 'addToCart'])->name('trangsuc.addtocart'); // Thêm sản phẩm vào giỏ
    Route::post('/update-cart/{id}', [TrangSucController::class, 'updateCart'])->name('trangsuc.updatecart'); // Cập nhật số lượng trong giỏ
    Route::get('/del-cart/{id}', [TrangSucController::class, 'delCart'])->name('trangsuc.delcart'); // Xóa sản phẩm khỏi giỏ
    Route::get('/thanh-toan', [TrangSucController::class, 'checkout'])->name('trangsuc.checkout'); // Hiển thị form thanh toán
    Route::post('/thanh-toan', [TrangSucController::class, 'postCheckout'])->name('trangsuc.postcheckout'); // Xử lý lưu đơn hàng khi thanh toán
    
    // ---- 3. Nhóm Xác thực khách hàng (Đăng nhập, Đăng ký) ----
    Route::get('/dang-nhap', [TrangSucController::class, 'login'])->name('trangsuc.login'); // Form đăng nhập
    Route::post('/dang-nhap', [TrangSucController::class, 'postLogin'])->name('trangsuc.postlogin'); // Xử lý xác thực đăng nhập
    Route::get('/dang-ky', [TrangSucController::class, 'register'])->name('trangsuc.register'); // Form đăng ký tài khoản
    Route::post('/dang-ky', [TrangSucController::class, 'postRegister'])->name('trangsuc.postregister'); // Xử lý lưu tài khoản mới
    Route::get('/dang-xuat', [TrangSucController::class, 'logout'])->name('trangsuc.logout'); // Đăng xuất và xóa session
    
    // ---- 4. Nhóm Tài khoản cá nhân, Yêu thích & Lịch sử Đơn hàng ----
    Route::get('/tai-khoan', [TrangSucController::class, 'profile'])->name('trangsuc.profile'); // Thông tin tài khoản (cần đăng nhập)
    Route::post('/tai-khoan', [TrangSucController::class, 'postProfile'])->name('trangsuc.postprofile'); // Cập nhật thông tin cá nhân
    Route::get('/lich-su-don-hang', [TrangSucController::class, 'orderHistory'])->name('trangsuc.order_history'); // Xem các đơn đã mua
    Route::get('/yeu-thich', [WishlistController::class, 'index'])->name('trangsuc.wishlist'); // Xem danh sách sản phẩm yêu thích
    Route::get('/add-to-wishlist/{id}', [WishlistController::class, 'add'])->name('trangsuc.addtowishlist'); // Thêm vào danh sách yêu thích
    Route::get('/del-wishlist/{id}', [WishlistController::class, 'remove'])->name('trangsuc.removewishlist'); // Xóa khỏi danh sách yêu thích
    
    // ---- 5. Nhóm Liên hệ ----
    Route::get('/lien-he', [TrangSucController::class, 'contact'])->name('trangsuc.contact'); // Form gửi liên hệ
    Route::post('/lien-he', [TrangSucController::class, 'postContact'])->name('trangsuc.postcontact'); // Xử lý lưu tin nhắn liên hệ vào Database
});

/*
|--------------------------------------------------------------------------
| ROUTES QUẢN TRỊ (Admin Trang Sức)
|--------------------------------------------------------------------------
| Chỉ các tài khoản có phân quyền quản trị viên (level 1 hoặc 2) mới 
| được phép truy cập vào các đường dẫn này.
*/

Route::prefix('admin-trangsuc')->group(function () {
    Route::get('/', [TrangSucAdminController::class, 'dashboard'])->name('trangsuc.admin.dashboard'); // Bảng điều khiển chung
    
    // -- Quản lý người dùng (Thêm/Sửa/Xóa tài khoản) --
    Route::get('/users', [TrangSucAdminController::class, 'users'])->name('trangsuc.admin.users');
    Route::get('/users/delete/{id}', [TrangSucAdminController::class, 'deleteUser'])->name('trangsuc.admin.users.delete');

    // -- Quản lý danh mục sản phẩm (Loại trang sức) --
    Route::get('/categories', [TrangSucAdminController::class, 'categories'])->name('trangsuc.admin.categories');
    Route::get('/categories/delete/{id}', [TrangSucAdminController::class, 'deleteCategory'])->name('trangsuc.admin.categories.delete');

    // -- Quản lý sản phẩm (Các mẫu trang sức) --
    Route::get('/products', [TrangSucAdminController::class, 'products'])->name('trangsuc.admin.products');
    Route::get('/products/delete/{id}', [TrangSucAdminController::class, 'deleteProduct'])->name('trangsuc.admin.products.delete');

    // -- Quản lý đơn đặt hàng của khách --
    Route::get('/orders', [TrangSucAdminController::class, 'orders'])->name('trangsuc.admin.orders');
    Route::post('/orders/update-status/{id}', [TrangSucAdminController::class, 'updateOrderStatus'])->name('trangsuc.admin.orders.update');

    // -- Quản lý băng chuyền hình ảnh (Slider) --
    Route::get('/slides', [TrangSucAdminController::class, 'slides'])->name('trangsuc.admin.slides');
    Route::get('/slides/delete/{id}', [TrangSucAdminController::class, 'deleteSlide'])->name('trangsuc.admin.slides.delete');

    // -- Quản lý hộp thư Liên hệ & Phản hồi khách hàng --
    Route::get('/contacts', [TrangSucAdminController::class, 'contacts'])->name('trangsuc.admin.contacts');
    Route::post('/contacts/reply/{id}', [TrangSucAdminController::class, 'replyContact'])->name('trangsuc.admin.contacts.reply');
    Route::get('/contacts/delete/{id}', [TrangSucAdminController::class, 'deleteContact'])->name('trangsuc.admin.contacts.delete');
});

// Chuyển hướng người dùng vào thẳng trang sức khi gõ địa chỉ gốc (/)
Route::get('/', function() {
    return redirect()->route('trangsuc.index');
});