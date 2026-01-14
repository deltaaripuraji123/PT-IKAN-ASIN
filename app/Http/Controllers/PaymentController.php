<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Tampilkan halaman pembayaran untuk order tertentu.
     */
    public function show(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya sendiri
        if ($order->user_id != Auth::id()) {
            return redirect()->route('order.history')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Pastikan status pembayaran masih 'pending'
        if ($order->payment_status !== 'pending') {
            return redirect()->route('order.detail', $order->id)->with('error', 'Pesanan ini sudah dibayar atau tidak dapat dibayar lagi.');
        }

        // Load relasi yang diperlukan
        $order->load('orderItems.product', 'user');

        return view('payment.show', compact('order'));
    }
}