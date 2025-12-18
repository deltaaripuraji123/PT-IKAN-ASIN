@extends('admin.layouts.dashboard')

@section('title', 'Detail Pesanan #{{ $order->id }} - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <nav class="text-sm mb-4">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a>
        <span class="mx-2">/</span>
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline">Pesanan</a>
        <span class="mx-2">/</span>
        <span class="text-gray-500">Detail Pesanan #{{ $order->id }}</span>
    </nav>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Informasi Pesanan & Produk -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Pesanan -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Nomor Pesanan:</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-200">#{{ $order->id }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Tanggal Pesanan:</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Status Pembayaran:</p>
                        <span class="px-2 py-1 bg-{{ $order->payment_status === 'paid' ? 'green' : 'yellow' }}-100 text-{{ $order->payment_status === 'paid' ? 'green' : 'yellow' }}-800 rounded-full text-sm">
                            {{ $order->payment_status === 'paid' ? 'Dibayar' : 'Menunggu Pembayaran' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Status Pesanan:</p>
                        <span class="px-2 py-1 bg-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-100 text-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-800 rounded-full text-sm">
                            {{ $order->order_status === 'pending' ? 'Menunggu' : ($order->order_status === 'processing' ? 'Diproses' : ($order->order_status === 'shipped' ? 'Dikirim' : 'Selesai')) }}
                        </span>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-600 dark:text-gray-400">Alamat Pengiriman:</p>
                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->address }}</p>
                </div>
            </div>
            
            <!-- Informasi Customer (BARU) -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Customer</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Nama:</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Email:</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Telepon:</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->user->phone }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Produk yang Dipesan -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Produk yang Dipesan</h2>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center border-b dark:border-gray-700 pb-4">
                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center mr-4">
                                @if($item->product->image)
                                    <img src="{{ asset('images/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded">
                                @else
                                    <i class="fas fa-fish text-2xl text-gray-400 dark:text-gray-500"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->quantity }} x Rp. {{ number_format($item->subtotal_price / $item->quantity, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-800 dark:text-gray-200">Rp. {{ number_format($item->subtotal_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Kolom Kanan: Ringkasan & Update Status -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Ringkasan Pembayaran -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Ringkasan Pembayaran</h2>
                
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Ongkir:</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">Rp. {{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t dark:border-gray-700 pt-2 flex justify-between font-semibold text-lg">
                        <span class="text-gray-800 dark:text-gray-200">Total:</span>
                        <span class="text-gray-800 dark:text-gray-200">Rp. {{ number_format($order->total_price + ($order->shipping_cost ?? 0), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Update Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Update Status</h2>
                
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="order_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Order</label>
                        <select id="order_status" name="order_status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pembayaran</label>
                        <select id="payment_status" name="payment_status" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection