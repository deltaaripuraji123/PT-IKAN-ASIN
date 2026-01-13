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

    <!-- AWAL TAMBAHAN: INFORMASI PESANAN -->
    <div class="border-t pt-4">
        <h3 class="text-lg font-semibold mb-2">Informasi Pemesan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div>
                <p class="text-gray-600">Nama Pemesan:</p>
                <p class="font-semibold">{{ $order->customer_name }}</p>
            </div>
            <div>
                <p class="text-gray-600">Email Pemesan:</p>
                <p class="font-semibold">{{ $order->customer_email }}</p>
            </div>
            <div>
                <p class="text-gray-600">Telepon Pemesan:</p>
                <p class="font-semibold">{{ $order->customer_phone }}</p>
            </div>
        </div>
    </div>
    <!-- AKHIR TAMBAHAN -->

    <div class="mb-4">
        <p class="text-gray-600">Alamat Pengiriman:</p>
        <p class="font-semibold">{{ $order->address }}</p>
    </div>
</div>