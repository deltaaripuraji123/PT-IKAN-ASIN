<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_price');
        $pendingOrders = Order::where('order_status', 'pending')->count();
        
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalCustomers', 
            'totalRevenue', 
            'pendingOrders',
            'recentOrders'
        ));
    }
}