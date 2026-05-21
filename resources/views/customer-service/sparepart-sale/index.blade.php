<x-app-layout>
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-5 mt-5">
            <div>
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Data Penjualan Sparepart
                </h1>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('cs.sale.create') }}" class="btn bg-blue-500 text-white hover:bg-blue-600">
                    <i class="fas fa-plus mr-1"></i> Penjualan Baru
                </a>
            </div>
        </div>

        <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800 dark:text-slate-300">
            <div class="p-6">
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg overflow-hidden"
                    id="sale-table">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3">Kode Nota</th>
                            <th scope="col" class="px-6 py-3">Pelanggan</th>
                            <th scope="col" class="px-6 py-3">Item Sparepart</th>
                            <th scope="col" class="px-6 py-3">Metode</th>
                            <th scope="col" class="px-6 py-3">Total</th>
                            <th scope="col" class="px-6 py-3">Dibayar</th>
                            <th scope="col" class="px-6 py-3">Kembalian</th>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const rupiah = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            });

            const table = $('#sale-table').DataTable({
                dom: '<"flex mb-4 "<" "f> <""l>   <"flex-grow"B>> t <"row py-4"<"col-md-6"i><"col-md-6 text-end"p>>',
                processing: true,
                serverSide: true,
                ajax: '{{ route('cs.sale.getSale') }}',
                ordering: false,
                columns: [
                    {
                        data: 'kode_pesanan',
                        name: 'kode_pesanan',
                        render: function(data, type, row) {
                            const url = "{{ route('cs.sale.show', ['id' => '__ID__']) }}".replace('__ID__', row.id);
                            return `<a href="${url}" class="font-bold text-gray-900 hover:text-blue-600">${data || '-'}</a>`;
                        }
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name',
                        render: function(data, type, row) {
                            return `<div class="font-medium text-gray-800">${data || '-'}</div>
                                <div class="text-xs text-gray-400">${row.customer_phone || '-'}</div>`;
                        }
                    },
                    {
                        data: 'items_summary',
                        name: 'items_summary',
                        render: function(data, type, row) {
                            return `<div>${data || '-'}</div>
                                <div class="text-xs text-gray-400">${row.item_count || 0} item</div>`;
                        }
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method',
                        defaultContent: '-'
                    },
                    {
                        data: 'total',
                        name: 'total',
                        render: function(data) {
                            return `<span class="font-semibold text-gray-800">${rupiah.format(Number(data || 0))}</span>`;
                        }
                    },
                    {
                        data: 'nominal_bayar',
                        name: 'nominal_bayar',
                        render: function(data) {
                            return rupiah.format(Number(data || 0));
                        }
                    },
                    {
                        data: 'kembalian',
                        name: 'kembalian',
                        render: function(data) {
                            return rupiah.format(Number(data || 0));
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            if (!data) return '-';
                            return new Date(data).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                        }
                    },
                    {
                        data: 'id',
                        render: function(data) {
                            const detailUrl = "{{ route('cs.sale.show', ['id' => '__ID__']) }}".replace('__ID__', data);
                            const printUrl = "{{ route('print.sale', ['id' => '__ID__']) }}".replace('__ID__', data);
                            return `<div class="flex items-center gap-3">
                                <a href="${detailUrl}" class="text-blue-500 hover:text-blue-700" title="Lihat detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="${printUrl}" class="text-gray-500 hover:text-gray-800" title="Cetak nota">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
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
