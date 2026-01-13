@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Ikan Asin Store')

@section('content')
<div class="bg-gray-100 min-h-screen py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            
            <!-- Header Sukses -->
            <div class="p-8 text-center border-b border-gray-100">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-green-600 text-3xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Pesanan Anda Berhasil!</h1>
                <p class="text-gray-600">
                    Terima kasih telah berbelanja di toko kami. Pesanan Anda dengan nomor <strong>#{{ $order->id }}</strong> telah kami terima dan sedang diproses.
                </p>
            </div>
            
            <!-- Detail Pesanan -->
            <div class="p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-l-4 border-blue-600 pl-3">Ringkasan Pesanan</h2>
                
                <div class="space-y-4">
                    <!-- Info Order -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Informasi Pesanan</h3>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-600">Nomor Pesanan:</span>
                                <span class="font-semibold text-gray-800">#{{ $order->id }}</span>
                            </div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-600">Tanggal:</span>
                                <span class="text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Pembayaran:</span>
                                <span class="font-bold text-blue-600">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Status</h3>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Pembayaran:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($order->payment_status === 'paid') bg-green-100 text-green-800 
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ $order->payment_status === 'paid' ? 'Dibayar' : 'Menunggu Pembayaran' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Pesanan:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($order->order_status === 'pending') bg-yellow-100 text-yellow-800 
                                    @elseif($order->order_status === 'processing') bg-blue-100 text-blue-800 
                                    @elseif($order->order_status === 'shipped') bg-purple-100 text-purple-800 
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $order->order_status === 'pending' ? 'Menunggu' : ($order->order_status === 'processing' ? 'Diproses' : ($order->order_status === 'shipped' ? 'Dikirim' : 'Selesai')) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pengiriman & Kontak (Bagian Baru) -->
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        <h3 class="text-sm font-bold text-blue-800 uppercase tracking-wider mb-4 flex items-center">
                            <i class="fas fa-shipping-fast mr-2"></i> Detail Pengiriman
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-4 text-sm">
                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="w-24 flex-shrink-0 text-gray-500 font-medium">Email</div>
                                <div class="text-gray-800 font-medium">{{ Auth::user()->email }}</div>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="flex items-start">
                                <div class="w-24 flex-shrink-0 text-gray-500 font-medium">Telepon</div>
                                <div class="text-gray-800">
                                    {{ Auth::user()->phone ?? '-' }}
                                    {{-- Jika nomor telepon tersimpan di model order, gunakan $order->phone --}}
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="flex items-start">
                                <div class="w-24 flex-shrink-0 text-gray-500 font-medium">Alamat</div>
                                <div class="text-gray-800 leading-relaxed">
                                    {{ $order->address }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="bg-gray-50 p-6 flex flex-col sm:flex-row gap-4 justify-center border-t border-gray-100">
                <a href="{{ route('order.detail', $order->id) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-sm hover:shadow text-center">
                    <i class="fas fa-receipt mr-2"></i> Lihat Detail Pesanan
                </a>
                <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-white text-gray-700 border border-gray-300 rounded-lg font-semibold hover:bg-gray-50 transition shadow-sm hover:shadow text-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection