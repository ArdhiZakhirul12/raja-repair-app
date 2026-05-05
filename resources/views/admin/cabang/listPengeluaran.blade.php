<x-app-layout>



    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="flex justify-between my-4 sm:mb-5">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Data Pengeluaran
            </h1>
            <form method="GET" action="{{ route('admin.cabang.listAdminCabangSpending', ['id' => request('id')]) }}">

                <!-- Right: Actions -->
                <input type="hidden" name="id" value={{ request('id') }}>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end">
                    <input type="text" name="date_range" class="rounded-lg" value="{{ request('date_range') }}" />

                    <button type="submit"
                        class="btn ml-2 bg-blue-400 text-white hover:bg-gray-800  dark:text-gray-800 dark:hover:bg-white">

                        <span class="max-xs:sr-only">Sesuaikan</span>
                    </button>

                </div>
            </form>
            {{-- <button   class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
        onclick="document.getElementById('add-sparepart-modal').classList.remove('hidden')">
        Tambah Sparepart
    </button> --}}
        </div>
        <div class="grid grid-cols-12 gap-4 mb-4">
            <x-dashboard.dashboard-card-06-uang title="Pendapatan Bersih"
                total="Rp {{ number_format($pendapatan_bersih, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Total Pendapatan"
                total="Rp {{ number_format($total_pendapatan, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Total Pengeluaran"
                total="Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}" />
        </div>
        <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800 dark:text-slate-300">


            <div class="p-6">




                <!-- Tabel Pelanggan -->
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg overflow-hidden"
                    id="admin-spending-table">
                    <thead>
                        <tr>
                            {{-- <th scope="col" class="px-6 py-3"></th> --}}
                            {{-- <th></th> --}}
                            <th scope="col" class="px-6 py-3">id</th>

                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Referensi
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Metode Pembayaran
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Jumlah
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Tanggal
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Harga
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>

                            <th></th>


                        </tr>
                    </thead>


                </table>
            </div>
        </div>
    </div>

    <script>
        //fungsi untuk memanggil datatable dan mengatur fitur-fitur yang ada
        let table = $(document).ready(function() {
            $('#admin-spending-table').DataTable({
                dom: '<"flex mb-4 "<" "f> <""l>   <"flex-grow"B>> t <"row py-4"<"col-md-6"i><"col-md-6 text-end"p>>',
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.cabang.getAdminCabangSpendings', ['id' => $cabang_id]) }}',
                    data: function(d) {
                        d.date_range = $('input[name="date_range"]')
                    .val(); // get the date range value from input
                    }
                },
                ordering: false,
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row) {
                            let url = "{{ route('cs.booking.show', ['id' => '__ID__']) }}";
                            url = url.replace('__ID__', row.id);
                            return `<a href="${url}" class="text-black-900 hover:text-black-400 font-bold">${data}</a>`;

                        }
                    },
                    {
                        data: 'referensi',
                        name: 'referensi',

                    },
                    {
                        data: 'metode_pembayaran_id',
                        name: 'metode_pembayaran_id',


                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah',


                    },

                    {
                        data: 'tanggal',
                        name: 'tanggal',


                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        render: function(data) {
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(data);
                        }
                    },


                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `<button class="text-blue-500 hover:text-blue-700" 
                                            data-id="${row.id}" 
                                    
                                           onclick="window.location.href='{{ route('cs.spending.show', ['id' => '__ID__']) }}'.replace('__ID__', ${row.id})">
                    <i class="fas fa-eye"></i>
                </button>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
                buttons: [


                    {
                        extend: 'excel',
                        text: 'Excel'
                    },
                    // {
                    //     extend: 'pdf',
                    //     text: 'PDF'
                    // },
                    {
                        extend: 'print',
                        text: 'Print'
                    }
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
                pageLength: 10,
                order: [
                    [0, 'desc']
                ],
            });
        });



        $(function() {
            $('input[name="date_range"]').daterangepicker({
                opens: 'left',
                locale: {
                    applyLabel: 'Pilih', // Ganti label Apply jadi "Pilih"
                    cancelLabel: 'Batal', // (Opsional) Ganti Cancel jadi "Batal"
                    format: 'YYYY-MM-DD' // (Opsional) Format tanggal
                }

            }, function(start, end, label) {

                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));

            });

            // Add clear button functionality
            const clearButton = $('<button>')
                .text('Clear')
                .addClass('btn ml-2 bg-red-400 text-white hover:bg-red-600')
                .on('click', function() {
                    $('input[name="date_range"]').val('');
                });

            $('input[name="date_range"]').after(clearButton);
        });
    </script>






</x-app-layout>
