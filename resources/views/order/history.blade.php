@extends('layouts.app')

@section('title', 'Riwayat Pesanan - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Riwayat Pesanan</h1>
    
    @if($orders->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-left p-4">Nomor Pesanan</th>
                            <th class="text-left p-4">Tanggal</th>
                            <th class="text-left p-4">Total</th>
                            <th class="text-left p-4">Status Pembayaran</th>
                            <th class="text-left p-4">Status Pesanan</th>
                            <th class="text-center p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">#{{ $order->id }}</td>
                                <td class="p-4">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="p-4">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-{{ $order->payment_status === 'paid' ? 'green' : 'yellow' }}-100 text-{{ $order->payment_status === 'paid' ? 'green' : 'yellow' }}-800 rounded-full text-sm">
                                        {{ $order->payment_status === 'paid' ? 'Dibayar' : 'Menunggu Pembayaran' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-100 text-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-800 rounded-full text-sm">
                                        {{ $order->order_status === 'pending' ? 'Menunggu' : ($order->order_status === 'processing' ? 'Diproses' : ($order->order_status === 'shipped' ? 'Dikirim' : 'Selesai')) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('order.detail', $order->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-4">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-clipboard-list text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-semibold mb-4">Belum Ada Riwayat Pesanan</h2>
            <p class="text-gray-600 mb-6">Anda belum pernah melakukan pesanan.</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection