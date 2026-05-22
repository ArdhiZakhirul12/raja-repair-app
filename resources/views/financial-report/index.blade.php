<x-app-layout>
    @php
        $money = fn ($value) => 'Rp ' . number_format((int) $value, 0, ',', '.');
        $date = fn ($value) => $value ? $value->format('d/m/Y H:i') : '-';
    @endphp

    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-5">
            <div>
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Laporan Keuangan
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 mb-5">
            <form method="GET" action="{{ route('financial-report.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ $startDate->toDateString() }}"
                        class="form-input w-full dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ $endDate->toDateString() }}"
                        class="form-input w-full dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                </div>
                @if (Auth::user()->hasRole('super-admin'))
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cabang</label>
                        <select name="cabang" class="form-select w-full dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                            <option value="all" @selected($selectedCabang === 'all')>Semua Cabang</option>
                            @foreach ($cabangs as $cabang)
                                <option value="{{ $cabang->user_id }}" @selected((string) $selectedCabang === (string) $cabang->user_id)>
                                    {{ $cabang->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div>
                    <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white w-full md:w-auto">
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4 mb-5">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Omzet</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-2">{{ $money($overall['revenue']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Omzet Service</p>
                <p class="text-2xl font-bold text-blue-600 mt-2">{{ $money($overall['service_revenue']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Omzet Sparepart</p>
                <p class="text-2xl font-bold text-indigo-600 mt-2">{{ $money($overall['sparepart_revenue']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">HPP Sparepart</p>
                <p class="text-2xl font-bold text-amber-600 mt-2">{{ $money($overall['hpp']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Laba Bersih</p>
                <p class="text-2xl font-bold {{ $overall['net_profit'] >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                    {{ $money($overall['net_profit']) }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-5">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Laba Kotor</p>
                <p class="text-2xl font-bold text-green-600 mt-2">{{ $money($overall['gross_profit']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Pengeluaran</p>
                <p class="text-2xl font-bold text-red-600 mt-2">{{ $money($overall['expenses']) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Transaksi</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-2">{{ number_format($overall['transactions'], 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 mb-5">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Ringkasan Per Flow</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Flow</th>
                            <th class="px-4 py-3">Transaksi</th>
                            <th class="px-4 py-3">Service</th>
                            <th class="px-4 py-3">Sparepart</th>
                            <th class="px-4 py-3">Total Omzet</th>
                            <th class="px-4 py-3">HPP</th>
                            <th class="px-4 py-3">Laba Kotor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flows as $flow)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 font-semibold">{{ $flow['label'] }}</td>
                                <td class="px-4 py-3">{{ number_format($flow['transactions'], 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $money($flow['service_revenue']) }}</td>
                                <td class="px-4 py-3">{{ $money($flow['sparepart_revenue']) }}</td>
                                <td class="px-4 py-3 font-semibold">{{ $money($flow['revenue']) }}</td>
                                <td class="px-4 py-3">{{ $money($flow['hpp']) }}</td>
                                <td class="px-4 py-3 font-semibold {{ $flow['gross_profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $money($flow['gross_profit']) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('financial-report.partials.detail-table', [
            'title' => 'Detail Service',
            'rows' => $serviceOnlyRows,
            'showService' => true,
            'showSparepart' => false,
            'showHpp' => false,
            'money' => $money,
            'date' => $date,
        ])

        @include('financial-report.partials.detail-table', [
            'title' => 'Detail Service + Sparepart',
            'rows' => $serviceSparepartRows,
            'showService' => true,
            'showSparepart' => true,
            'showHpp' => true,
            'money' => $money,
            'date' => $date,
        ])

        @include('financial-report.partials.detail-table', [
            'title' => 'Detail Sparepart Saja',
            'rows' => $sparepartOnlyRows,
            'showService' => false,
            'showSparepart' => true,
            'showHpp' => true,
            'money' => $money,
            'date' => $date,
        ])
    </div>
</x-app-layout>
