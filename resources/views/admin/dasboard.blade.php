@extends('layouts.app')

@section('title', 'Admin Dashboard - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-box text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-600">Total Produk</p>
                    <p class="text-2xl font-bold">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-600">Total Customer</p>
                    <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-money-bill-wave text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-bold">Rp. {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-clipboard-list text-red-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-600">Pesanan Pending</p>
                    <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Pesanan Terbaru</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left pb-3">Nomor</th>
                        <th class="text-left pb-3">Customer</th>
                        <th class="text-left pb-3">Tanggal</th>
                        <th class="text-left pb-3">Total</th>
                        <th class="text-left pb-3">Status</th>
                        <th class="text-center pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">#{{ $order->id }}</td>
                            <td class="py-3">{{ $order->user->name }}</td>
                            <td class="py-3">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="py-3">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 bg-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-100 text-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-800 rounded-full text-sm">
                                    {{ $order->order_status === 'pending' ? 'Menunggu' : ($order->order_status === 'processing' ? 'Diproses' : ($order->order_status === 'shipped' ? 'Dikirim' : 'Selesai')) }}
                                </span>
                            </td>
                            <td class="py-3 text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline">Lihat Semua Pesanan</a>
        </div>
    </div>
</div>
@endsection