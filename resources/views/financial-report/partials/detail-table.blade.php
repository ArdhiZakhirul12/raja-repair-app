<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 mb-5">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ $title }}</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Pelanggan</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Item</th>
                    @if ($showService)
                        <th class="px-4 py-3">Service</th>
                    @endif
                    @if ($showSparepart)
                        <th class="px-4 py-3">Sparepart</th>
                    @endif
                    <th class="px-4 py-3">Omzet</th>
                    @if ($showHpp)
                        <th class="px-4 py-3">HPP</th>
                    @endif
                    <th class="px-4 py-3">Laba Kotor</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr class="border-b dark:border-gray-700 align-top">
                        <td class="px-4 py-3 font-semibold">{{ $row['code'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row['customer'] }}</td>
                        <td class="px-4 py-3">{{ $date($row['date']) }}</td>
                        <td class="px-4 py-3 min-w-52">{{ $row['items'] ?: '-' }}</td>
                        @if ($showService)
                            <td class="px-4 py-3">{{ $money($row['service_revenue']) }}</td>
                        @endif
                        @if ($showSparepart)
                            <td class="px-4 py-3">{{ $money($row['sparepart_revenue']) }}</td>
                        @endif
                        <td class="px-4 py-3 font-semibold">{{ $money($row['revenue']) }}</td>
                        @if ($showHpp)
                            <td class="px-4 py-3">{{ $money($row['hpp']) }}</td>
                        @endif
                        <td class="px-4 py-3 font-semibold {{ $row['profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $money($row['profit']) }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ $row['url'] }}" class="text-blue-600 hover:text-blue-800 font-medium">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-5 text-center text-gray-500">
                            Belum ada transaksi pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
