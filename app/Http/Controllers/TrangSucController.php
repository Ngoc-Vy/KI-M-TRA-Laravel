<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Type_product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TrangSucController extends Controller
{
    public function __construct()
    {
        // Share categories to all views
        $categories = Type_product::all();
        \view()->share('categories', $categories);
    }

    public function index() {
        $new_products = Product::where('new', 1)->orderBy('id', 'DESC')->take(8)->get();
        $promotion_products = Product::where('promotion_price', '<>', 0)->take(8)->get();
        $top_products = Product::where('top', 1)->take(8)->get();
        $all_products = Product::paginate(12);
        
        return view('trangsuc.index', compact('new_products', 'top_products', 'promotion_products', 'all_products'));
    }

    public function detail($id) {
        $product = Product::findOrFail($id);
        $related_products = Product::where('id_type', $product->id_type)->where('id', '!=', $id)->take(4)->get();
        return view('trangsuc.detail', compact('product', 'related_products'));
    }

    public function category($id) {
        $category = Type_product::findOrFail($id);
        $products = Product::where('id_type', $id)->paginate(12);
        return view('trangsuc.category', compact('category', 'products'));
    }

    public function search(Request $request) {
        $query = $request->s;
        $products = Product::where('name', 'like', '%'.$query.'%')->paginate(12);
        return view('trangsuc.search', compact('products', 'query'));
    }

    // -- Authentication --
    public function login() { return view('trangsuc.login'); }
    public function postLogin(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->level == 1 || Auth::user()->level == 2) {
                return redirect()->route('trangsuc.admin.dashboard')->with('success', 'Đăng nhập trang quản trị thành công');
            }
            return redirect()->route('trangsuc.index')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->back()->with('error', 'Sai thông tin đăng nhập');
    }
    public function register() { return view('trangsuc.register'); }
    public function postRegister(Request $request) {
        $user = new User();
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 3;
        $user->save();
        return redirect()->route('trangsuc.login')->with('success', 'Đăng ký thành công');
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('trangsuc.index');
    }

    // -- Cart --
    public function cart() { return view('trangsuc.cart'); }
    public function addToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->route('trangsuc.cart');
    }
    public function updateCart(Request $request, $id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        if($oldCart){
            $cart = new Cart($oldCart);
            $cart->updateItem($id, $request->qty);
            Session::put('cart', $cart);
        }
        return redirect()->back();
    }
    public function delCart($id) {
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){ Session::put('cart',$cart); } else { Session::forget('cart'); }
        return redirect()->back();
    }

    // -- Checkout --
    public function checkout() { return view('trangsuc.checkout'); }
    public function postCheckout(Request $request) {
        if (!Session::has('cart')) return redirect()->back()->with('error', 'Giỏ hàng trống!');
        $cart=Session::get('cart');
        
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->gender = 'Khác';
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone;
        $customer->note = '';
        $customer->save();

        $bill = new Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->payment;
        $bill->save();

        foreach($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }

        // Gửi email xác nhận
        \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\OrderSuccessMail($bill, $cart));

        Session::forget('cart');
        return redirect()->route('trangsuc.index')->with('success', 'Đặt hàng thành công! Vui lòng kiểm tra email của bạn.');
    }

    // -- Profile & Orders --
    public function profile() { 
        if(!Auth::check()) return redirect()->route('trangsuc.login');
        return view('trangsuc.profile'); 
    }
    public function postProfile(Request $request) {
        if(!Auth::check()) return redirect()->route('trangsuc.login');
        $user = User::find(Auth::id());
        $user->full_name = $request->name;
        if($request->password) $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
    public function orderHistory() {
        if(!Auth::check()) return redirect()->route('trangsuc.login');
        $customer = Customer::where('email', Auth::user()->email)->first();
        $orders = $customer ? Bill::where('id_customer', $customer->id)->with('bill_details.product')->orderBy('id', 'desc')->get() : collect();
        return view('trangsuc.order_history', compact('orders'));
    }
    public function wishlist() {
        if(!Auth::check()) return redirect()->route('trangsuc.login');
        $wishlists = \App\Models\Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('trangsuc.wishlist', compact('wishlists'));
    }

    // -- Contact --
    public function contact() { return view('trangsuc.contact'); }
    public function postContact(Request $request) {
        Contact::create(['name' => $request->name, 'email' => $request->email, 'message' => $request->message]);
        return redirect()->back()->with('success', 'Gửi liên hệ thành công!');
    }
}
