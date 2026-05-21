<x-app-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mt-5 mb-6">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-5">
            <div>
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Detail Penjualan Sparepart
                </h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('cs.sale.index') }}" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Kembali
                </a>
                <a href="{{ route('print.sale', ['id' => $sale->id]) }}" class="btn bg-blue-500 text-white hover:bg-blue-600">
                    <i class="fas fa-print mr-1"></i> Cetak Nota
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-400">Total Penjualan</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-400">Nominal Dibayar</p>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format((int) $sale->nominal_bayar, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-400">Kembalian</p>
                <p class="text-2xl font-bold text-green-600">Rp {{ number_format((int) $sale->kembalian, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Informasi Nota</h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-400">Kode Nota</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $sale->kode_pesanan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Tanggal</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $sale->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Metode Pembayaran</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $sale->metodePembayaran?->metode ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Keterangan</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $sale->keterangan ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Pelanggan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
                    <div>
                        <p class="text-gray-400">Nama</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $sale->customer?->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">No HP</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $sale->customer?->no_hp ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-gray-400">Alamat</p>
                        <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $sale->customer?->alamat ?? '-' }}</p>
                    </div>
                </div>

                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Item Sparepart</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="px-4 py-3">Sparepart</th>
                                <th class="px-4 py-3">Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sale->detailSale as $detail)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $detail->sparepart?->code ?? '-' }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $detail->sparepart?->nama_sparepart ?? '-' }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada item sparepart.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
