<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        $order->load('orderItems.product');
        
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,completed',
            'payment_status' => 'required|in:pending,paid'
        ]);
        
        $order->update([
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status
        ]);
        
        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Status pesanan berhasil diperbarui.');
    }
}