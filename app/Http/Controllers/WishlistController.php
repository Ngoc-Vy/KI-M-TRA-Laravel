<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('trangsuc.login')->with('error', 'Vui lòng đăng nhập để xem sản phẩm yêu thích');
        }
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('trangsuc.wishlist', compact('wishlists'));
    }

    public function add($id)
    {
        if (!Auth::check()) {
            return redirect()->route('trangsuc.login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm yêu thích');
        }
        
        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();
        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $id
            ]);
            return redirect()->back()->with('success', 'Đã thêm vào danh sách yêu thích!');
        }
        return redirect()->back()->with('warning', 'Sản phẩm đã có trong danh sách yêu thích.');
    }

    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('trangsuc.login');
        }
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi danh sách yêu thích');
    }
}
