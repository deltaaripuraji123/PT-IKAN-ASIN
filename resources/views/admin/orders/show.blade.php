<!-- ... (bagian sebelumnya tetap sama) ... -->

<!-- Kolom Kanan: Ringkasan & Update Status -->
<div class="space-y-6">
    <!-- Ringkasan Pesanan -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ringkasan Pesanan</h2>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <p class="text-gray-500 dark:text-gray-400">Subtotal Produk</p>
                <p class="font-medium text-gray-900 dark:text-white">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p class="text-gray-500 dark:text-gray-400">Ongkos Kirim</p>
                <p class="font-medium text-gray-900 dark:text-white">Rp. {{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</p>
            </div>
            <hr class="dark:border-gray-700">
            <div class="flex justify-between text-base">
                <p class="font-semibold text-gray-900 dark:text-white">Total</p>
                <p class="font-bold text-gray-900 dark:text-white">Rp. {{ number_format($order->total_price + ($order->shipping_cost ?? 0), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Update Status Pesanan (DIPERBARUI) -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Update Status Pesanan</h2>
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Status Order -->
            <div class="mb-4">
                <label for="order_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Order</label>
                <select name="order_status" id="order_status" class="w-full border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            
            <!-- Status Pembayaran -->
            <div class="mb-4">
                <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pembayaran</label>
                <select name="payment_status" id="payment_status" class="w-full border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Update Status
            </button>
        </form>
    </div>
</div>