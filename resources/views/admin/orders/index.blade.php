@extends('admin.layouts.dashboard')

@section('title', 'Kelola Pesanan - Admin')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola Pesanan</h1>
    </div>
    
    <!-- Table Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Nomor</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Customer</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Tanggal</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Total</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Status</th>
                        <th class="text-center p-4 font-medium text-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="p-4 font-medium text-gray-900 dark:text-white">#{{ $order->id }}</td>
                            <td class="p-4 text-gray-900 dark:text-white">{{ $order->user->name }}</td>
                            <td class="p-4 text-gray-600 dark:text-gray-300">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-4 text-gray-900 dark:text-white">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="p-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                        'processing' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                        'shipped' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu Pembayaran',
                                        'processing' => 'Diproses',
                                        'shipped' => 'Dikirim',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                    ];
                                    $colorClass = $statusColors[$order->order_status] ?? 'bg-gray-100 text-gray-800';
                                    $text = $statusText[$order->order_status] ?? ucfirst($order->order_status);
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                    {{ $text }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                Belum ada pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="p-4 border-t dark:border-gray-700">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection