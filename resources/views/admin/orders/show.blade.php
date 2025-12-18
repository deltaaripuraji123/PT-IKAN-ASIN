@extends('admin.layouts.dashboard')

@section('title', 'Detail Pesanan - Admin')

@section('content')
<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kolom Kiri (isi detail pesanan, boleh kamu isi sendiri) --}}
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Detail Pesanan</h2>
        <p class="text-sm text-gray-500">
            Isi detail produk, customer, dll di sini.
        </p>
    </div>

    {{-- Kolom Kanan --}}
    <div class="space-y-6">

        {{-- Ringkasan --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-lg font-semibold">Ringkasan Pesanan</h2>
            </div>

            <div class="p-6 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span class="font-medium">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span class="font-medium">
                        Rp {{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}
                    </span>
                </div>

                <div class="border-t pt-3 flex justify-between font-semibold">
                    <span>Total</span>
                    <span>
                        Rp {{ number_format($order->total_price + ($order->shipping_cost ?? 0), 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-lg font-semibold">Update Status</h2>
            </div>

            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm mb-1">Status Order</label>
                    <select name="order_status"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600">
                        <option value="pending" @selected($order->order_status=='pending')>Pending</option>
                        <option value="processing" @selected($order->order_status=='processing')>Processing</option>
                        <option value="shipped" @selected($order->order_status=='shipped')>Shipped</option>
                        <option value="completed" @selected($order->order_status=='completed')>Completed</option>
                        <option value="cancelled" @selected($order->order_status=='cancelled')>Cancelled</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm mb-1">Status Pembayaran</label>
                    <select name="payment_status"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600">
                        <option value="pending" @selected($order->payment_status=='pending')>Pending</option>
                        <option value="paid" @selected($order->payment_status=='paid')>Paid</option>
                    </select>
                </div>

                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Update Status
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
