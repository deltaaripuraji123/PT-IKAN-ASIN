@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id . ' - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900 inline-flex items-center">
                    <i class="fas fa-home mr-2"></i> Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('order.history') }}" class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2">Riwayat Pesanan</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-gray-500 ml-1 md:ml-2">Detail Pesanan #{{ $order->id }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Informasi Pesanan -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-600 text-sm">Nomor Pesanan:</p>
                <p class="font-semibold">#{{ $order->id }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Tanggal Pesanan:</p>
                <p class="font-semibold">{{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Status Pembayaran:</p>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    @if($order->payment_status === 'paid') bg-green-100 text-green-800 
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ $order->payment_status === 'paid' ? 'Dibayar' : 'Menunggu Pembayaran' }}
                </span>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Status Pesanan:</p>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    @if($order->order_status === 'completed') bg-green-100 text-green-800 
                    @elseif($order->order_status === 'shipped') bg-blue-100 text-blue-800 
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ $order->order_status === 'pending' ? 'Menunggu' : ($order->order_status === 'processing' ? 'Diproses' : ($order->order_status === 'shipped' ? 'Dikirim' : 'Selesai')) }}
                </span>
            </div>
        </div>

        <div class="border-t pt-4 mt-4">
            <h3 class="text-lg font-semibold mb-3">Informasi Pemesan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm bg-gray-50 p-4 rounded-lg">
                <div>
                    <p class="text-gray-600">Nama:</p>
                    <p class="font-semibold">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email:</p>
                    <p class="font-semibold">{{ $order->customer_email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Telepon:</p>
                    <p class="font-semibold">{{ $order->customer_phone }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Alamat Pengiriman:</p>
                    <p class="font-semibold">{{ $order->address }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Produk -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Detail Produk</h2>
        
        @if($order->orderItems->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('images/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="h-12 w-12 rounded-lg object-cover mr-3">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center mr-3">
                                                <i class="fas fa-fish text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product->name ?? 'Produk Dihapus' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                    Rp. {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900 text-center">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-4 py-4 text-sm font-medium text-gray-900 text-right">
                                    Rp. {{ number_format($item->subtotal_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 border-t-2 border-gray-200">
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-right text-sm font-bold text-gray-700">Total Pembayaran:</td>
                            <td class="px-4 py-4 text-right text-lg font-bold text-teal-600">
                                Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 py-4">Tidak ada produk dalam pesanan ini.</p>
        @endif
    </div>

    <!-- Tombol Aksi -->
    <div class="flex justify-between items-center">
        <a href="{{ route('order.history') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Riwayat
        </a>
        
        <!-- Saya sementara hapus tombol "Bayar Sekarang" untuk fokus memperbaiki tampilan -->
         @if($order->payment_status === 'pending')
            <a href="{{ route('payment.show', $order->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                <i class="fas fa-credit-card mr-2"></i> Bayar Sekarang
            </a>
        @endif
    </div>
</div>
@endsection