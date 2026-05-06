<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Type_product;
use App\Models\Bill;
use App\Models\Slide;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusMail;
use App\Mail\ContactReplyMail;

class TrangSucAdminController extends Controller
{
    private function checkAdmin() {
        if (!auth()->check() || auth()->user()->level == 3) {
            return redirect()->route('trangsuc.login')->with('error', 'Bạn không có quyền truy cập trang quản trị!');
        }
        return null;
    }

    public function dashboard() {
        if ($redirect = $this->checkAdmin()) return $redirect;
        return view('trangsuc.admin.dashboard');
    }

    // --- USERS ---
    public function users() {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $users = User::paginate(10);
        return view('trangsuc.admin.users', compact('users'));
    }
    public function deleteUser($id) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa người dùng!');
    }

    // --- CATEGORIES ---
    public function categories() {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $categories = Type_product::paginate(10);
        return view('trangsuc.admin.categories', compact('categories'));
    }
    public function deleteCategory($id) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        Type_product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa danh mục!');
    }

    // --- PRODUCTS ---
    public function products() {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $products = Product::paginate(10);
        return view('trangsuc.admin.products', compact('products'));
    }
    public function deleteProduct($id) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm!');
    }

    // --- ORDERS (TABS) ---
    public function orders(Request $request) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $status = $request->query('status', 'Mới');
        
        $newOrders = Bill::where('status', 'Mới')->orWhereNull('status')->get();
        $shippingOrders = Bill::where('status', 'Đang giao')->get();
        $deliveredOrders = Bill::where('status', 'Đã giao')->get();
        $canceledOrders = Bill::where('status', 'Đã hủy')->get();

        $currentOrders = collect();
        if ($status == 'Mới') $currentOrders = $newOrders;
        if ($status == 'Đang giao') $currentOrders = $shippingOrders;
        if ($status == 'Đã giao') $currentOrders = $deliveredOrders;
        if ($status == 'Đã hủy') $currentOrders = $canceledOrders;

        return view('trangsuc.admin.orders', compact('newOrders', 'shippingOrders', 'deliveredOrders', 'canceledOrders', 'currentOrders', 'status'));
    }

    public function updateOrderStatus(Request $request, $id) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $order = Bill::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        // Send email to customer
        if ($order->customer && $order->customer->email) {
            Mail::to($order->customer->email)->send(new OrderStatusMail($order));
        }
        
        return redirect()->back()->with('success', 'Đã cập nhật trạng thái đơn hàng và gửi email thông báo!');
    }

    // --- SLIDES ---
    public function slides() {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $slides = Slide::all();
        return view('trangsuc.admin.slides', compact('slides'));
    }
    public function deleteSlide($id) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        Slide::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa Slide!');
    }

    // --- CONTACTS ---
    public function contacts() {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(10);
        return view('trangsuc.admin.contacts', compact('contacts'));
    }

    public function replyContact(Request $request, $id) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        $contact = Contact::findOrFail($id);
        
        $contact->admin_reply = $request->reply;
        $contact->status = 'đã liên hệ';
        $contact->save();

        // Send email reply
        Mail::to($contact->email)->send(new ContactReplyMail($contact, $request->reply));

        return redirect()->back()->with('success', 'Đã gửi phản hồi đến khách hàng!');
    }

    public function deleteContact($id) {
        if ($redirect = $this->checkAdmin()) return $redirect;
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Đã xóa liên hệ!');
    }
}
