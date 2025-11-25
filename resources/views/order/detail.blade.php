@extends('layouts.app')

@section('title', 'Detail Pesanan #{{ $order->id }} - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8">
    <nav class="text-sm mb-4">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('order.history') }}" class="text-blue-600 hover:underline">Riwayat Pesanan</a>
        <span class="mx-2">/</span>
        <span class="text-gray-500">Detail Pesanan #{{ $order->id }}</span>
    </nav>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-600">Nomor Pesanan:</p>
                        <p class="font-semibold">#{{ $order->id }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Tanggal Pesanan:</p>
                        <p class="font-semibold">{{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Status Pembayaran:</p>
                        <span class="px-2 py-1 bg-{{ $order->payment_status === 'paid' ? 'green' : 'yellow' }}-100 text-{{ $order->payment_status === 'paid' ? 'green' : 'yellow' }}-800 rounded-full text-sm">
                            {{ $order->payment_status === 'paid' ? 'Dibayar' : 'Menunggu Pembayaran' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-600">Status Pesanan:</p>
                        <span class="px-2 py-1 bg-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-100 text-{{ $order->order_status === 'completed' ? 'green' : ($order->order_status === 'shipped' ? 'blue' : 'yellow') }}-800 rounded-full text-sm">
                            {{ $order->order_status === 'pending' ? 'Menunggu' : ($order->order_status === 'processing' ? 'Diproses' : ($order->order_status === 'shipped' ? 'Dikirim' : 'Selesai')) }}
                        </span>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="text-gray-600">Alamat Pengiriman:</p>
                    <p class="font-semibold">{{ $order->address }}</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Produk yang Dipesan</h2>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center mr-4">
                                @if($item->product->image)
                                    <img src="{{ asset('images/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded">
                                @else
                                    <i class="fas fa-fish text-2xl text-gray-400"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp. {{ number_format($item->subtotal_price / $item->quantity, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">Rp. {{ number_format($item->subtotal_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Ringkasan Pembayaran</h2>
                
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ongkir:</span>
                        <span>Gratis</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between font-semibold text-lg">
                        <span>Total:</span>
                        <span>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <a href="{{ route('order.history') }}" class="w-full bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center block">
                    Kembali ke Riwayat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection