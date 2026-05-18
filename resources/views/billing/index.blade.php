<x-app-layout>
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8 mb-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between mb-5">
            <div>
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Tagihan Aplikasi</h1>
            </div>

            <form method="GET" action="{{ route('billing.index') }}" class="flex flex-col gap-2 sm:flex-row sm:items-center">
                <input type="month" name="month" value="{{ $selectedMonth }}"
                    class="rounded-lg border-gray-300 text-sm">

                @if (Auth::user()->hasRole('super-admin'))
                    <select name="cabang" class="rounded-lg border-gray-300 text-sm">
                        <option value="all" @selected($selectedCabang === 'all')>Semua Cabang</option>
                        @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->user_id }}" @selected((string) $selectedCabang === (string) $cabang->user_id)>
                                {{ $cabang->nama }}
                            </option>
                        @endforeach
                    </select>
                @endif

                <button type="submit" class="btn bg-blue-500 text-white hover:bg-blue-600">Tampilkan</button>
            </form>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (Auth::user()->hasRole('super-admin'))
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 mb-4">
                <form method="POST" action="{{ route('billing.percentage.update') }}"
                    class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Persentase Tagihan
                        </label>
                        <div class="flex items-center gap-2 mt-1">
                            <input id="percentage" name="percentage" type="number" min="0" max="100" step="0.01"
                                value="{{ old('percentage', $percentage) }}"
                                class="w-40 rounded-lg border-gray-300 text-sm">
                            <span class="text-gray-700 dark:text-gray-300">%</span>
                        </div>
                        @error('percentage')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn bg-gray-800 text-white hover:bg-gray-900">Simpan Persentase</button>
                </form>
            </div>
        @endif

        <div class="grid grid-cols-12 gap-4 mb-4">
            <x-dashboard.dashboard-card-06-uang title="Tagihan Bulan Ini"
                total="Rp {{ number_format($totalBilling, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Total Service"
                total="Rp {{ number_format($totalService, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Persentase"
                total="{{ rtrim(rtrim(number_format($percentage, 2, ',', '.'), '0'), ',') }}%" />
        </div>

        @if (Auth::user()->hasRole('super-admin'))
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 mb-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">Total Per Cabang</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3">Cabang</th>
                                <th class="px-4 py-3">Total Service</th>
                                <th class="px-4 py-3">Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($branchTotals as $branch)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-medium">{{ $branch->cabang_nama }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($branch->total_service, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 font-semibold">Rp {{ number_format($branch->billing_amount, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 mb-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">Total Per Bulan</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Bulan</th>
                            <th class="px-4 py-3">Total Service</th>
                            <th class="px-4 py-3">Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($monthlyTotals as $month)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 font-medium">{{ $month->label }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($month->total_service, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 font-semibold">Rp {{ number_format($month->billing_amount, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">Detail Transaksi</h2>
            <div class="overflow-x-auto">
                <table id="billing-table" class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Nota</th>
                            @if (Auth::user()->hasRole('super-admin'))
                                <th class="px-4 py-3">Cabang</th>
                            @endif
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Service</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Total Service</th>
                            <th class="px-4 py-3">Tagihan</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr class="border-b dark:border-gray-700 align-top">
                                <td class="px-4 py-3 font-medium">{{ $transaction->kode_pesanan }}</td>
                                @if (Auth::user()->hasRole('super-admin'))
                                    <td class="px-4 py-3">{{ $transaction->user?->cabang?->nama ?? '-' }}</td>
                                @endif
                                <td class="px-4 py-3">{{ $transaction->customer?->nama ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    {{ $transaction->detailBooking->map(fn ($detail) => $detail->dataService?->nama_servis ?? 'Service')->implode(', ') }}
                                </td>
                                <td class="px-4 py-3">{{ $transaction->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ ucfirst($transaction->status) }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($transaction->total_service, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 font-semibold">Rp {{ number_format($transaction->billing_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('cs.booking.show', ['id' => $transaction->id]) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#billing-table').DataTable({
                dom: '<"flex mb-4 "<" "f> <""l>   <"flex-grow"B>> t <"row py-4"<"col-md-6"i><"col-md-6 text-end"p>>',
                ordering: false,
                buttons: [
                    { extend: 'excel', text: 'Excel' },
                    { extend: 'print', text: 'Print' }
                ],
                language: {
                    search: "Cari: ",
                    lengthMenu: "Show _MENU_ Data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10
            });
        });
    </script>
</x-app-layout>
