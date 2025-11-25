@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Ikan Asin Store')

@section('content')
<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-green-600 text-3xl"></i>
            </div>
            
            <h1 class="text-3xl font-bold mb-4">Pesanan Anda Berhasil!</h1>
            <p class="text-gray-600 mb-6">Terima kasih telah berbelanja di toko kami. Pesanan Anda dengan nomor #{{ $order->id }} telah kami terima.</p>
            
            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                <h2 class="text-lg font-semibold mb-4">Detail Pesanan</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nomor Pesanan:</span>
                        <span class="font-semibold">#{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal:</span>
                        <span>{{ $order->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pembayaran:</span>
                        <span class="font-semibold">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status Pembayaran:</span>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">{{ $order->payment_status }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status Pesanan:</span>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">{{ $order->order_status }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('order.detail', $order->id) }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Lihat Detail Pesanan
                </a>
                <a href="{{ route('home') }}" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection