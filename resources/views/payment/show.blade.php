@extends('layouts.app')

@section('title', 'Pembayaran Pesanan #' . $order->id)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Halaman Pembayaran</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-gray-600 text-sm">Nomor Pesanan:</p>
                <p class="font-semibold">#{{ $order->id }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Total Pembayaran:</p>
                <p class="font-bold text-xl text-teal-600">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="border-t pt-4">
            <p class="text-gray-600 mb-2">Metode Pembayaran:</p>
            <div class="space-y-2">
                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="transfer" checked class="mr-3" disabled>
                    <span>Transfer Bank (Simulasi)</span>
                </label>
            </div>
        </div>
    </div>

    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg mb-6">
        <p class="font-semibold mb-1"><i class="fas fa-info-circle mr-2"></i>Informasi Penting:</p>
        <p class="text-sm">Ini adalah halaman simulasi. Proses pembayaran sesungguhnya akan diintegrasikan dengan gateway pembayaran (Midtrans, Xendit, dll).</p>
    </div>

    <div class="flex justify-end space-x-3">
        <a href="{{ route('order.detail', $order->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail
        </a>
        <!-- Tombol ini hanya simulasi, fungsinya akan dikembangkan -->
        <button class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-teal-500 to-blue-600 hover:from-teal-600 hover:to-blue-700" disabled>
            <i class="fas fa-lock mr-2"></i> Konfirmasi Pembayaran (Segera)
        </button>
    </div>
</div>
@endsection