<x-app-layout>


    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-2 mt-5 sm:mb-5">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Data Transaksi
            </h1>
            {{-- <button   class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
        onclick="document.getElementById('add-sparepart-modal').classList.remove('hidden')">
        Tambah Sparepart
    </button> --}}
            <div class="mb-3">
                <button class="status-filter btn btn-primary" data-status="">All</button>
                <button class="status-filter btn " data-status="diproses">Diproses</button>
                <button class="status-filter btn " data-status="dikerjakan">Pengerjaan</button>
                <button class="status-filter btn " data-status="teknisi-selesai">Teknisi Selesai</button>
                <button class="status-filter btn " data-status="selesai">Selesai</button>
            </div>
            <input type="hidden" id="statusFilter" value="">
        </div>
        <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800 dark:text-slate-300">
            <div class="p-6">

                {{-- <p>{{ $bookings }}</p> --}}


                <!-- Tabel Pelanggan -->
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg overflow-hidden"
                    id="booking-table">
                    <thead>
                        <tr>
                            {{-- <th scope="col" class="px-6 py-3"></th> --}}

                            <th scope="col" class="px-6 py-3">Kode</th>

                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Nama
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Kendala
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Model Hp</th>

                            <th scope="col" class="px-6 py-3"></th>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <script>
        //fungsi untuk memanggil datatable dan mengatur fitur-fitur yang ada
        $(document).ready(function() {
           var table = $('#booking-table').DataTable({
                dom: '<"flex mb-4 "<" "f> <""l>   <"flex-grow"B>> t <"row py-4"<"col-md-6"i><"col-md-6 text-end"p>>',
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.diskon.getBooking') }}',
                    data: function(d) {
                        d.status = $('#statusFilter').val();
                        console.log(d); // Get the selected status filter
                    }
                },
                ordering: false,
                columns: [


                    {
                        data: 'kode_pesanan',
                        name: 'kode_pesanan',
                        render: function(data, type, row) {
                            let url = "{{ route('admin.diskon.show', ['id' => '__ID__']) }}";
                            url = url.replace('__ID__', row.id);
                            return `<a href="${url}" class="text-black-900 hover:text-black-400 font-bold">${data}</a>`;

                        }
                    },
                    {
                        data: 'customer_id',
                        name: 'customer_id',
                        render: function(data, type, row) {
                            return `<a href="" class="text-black-500 hover:text-black-500 ">${row.customer.nama}</a>`;

                        }
                    },
                    {
                        data: 'kendala',
                        name: 'kendala',


                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            let bgColor = '';
                            if (data.toLowerCase() === 'diproses') {
                                bgColor = 'bg-yellow-500 text-white';
                            } else if (data.toLowerCase() === 'selesai') {
                                bgColor = 'bg-green-500 text-white';
                            } else if (data.toLowerCase() === 'dikerjakan') {
                                bgColor = 'bg-blue-300 text-white';
                            } else if (data.toLowerCase() === 'teknisi-selesai') {
                                bgColor = 'bg-primary text-white';
                            }
                            return `<span class="px-2 py-1 rounded ${bgColor}">${data}</span>`;
                        }
                    },
                    {
                        data: 'hp_model_id',
                        name: 'hp_model_id',
                        render: function(data, type, row) {
                            // console.log(row);
                            return `<a href='' class="text-black-900 hover:text-black-500 font-bold">${row.hp_model.model}</a>`;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `<button class="text-blue-500 hover:text-blue-700" 
                                            data-id="${row.id}" 
                                            data-nama="${row.nama_sparepart}"
                                            data-harga="${row.harga}"
                                           onclick="window.location.href='{{ route('admin.diskon.show', ['id' => '__ID__']) }}'.replace('__ID__', ${row.id})">
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

        $('.status-filter').on('click', function() {
            var status = $(this).data('status');
            $('.status-filter').removeClass('btn-dark').addClass('btn-light text-gray-500');
            if(status == '') {
                $(this).removeClass('btn-light text-gray-500').addClass('btn-primary');
            } else if (status == 'diproses') {
                $(this).removeClass('btn-light text-gray-500').addClass('btn-warning');
            } else if (status == 'dikerjakan') {
                $(this).removeClass('btn-light text-gray-500').addClass('btn-info');
            } else if (status == 'teknisi-selesai') {
                $(this).removeClass('btn-light text-gray-500').addClass('btn-primary');
            } else if (status == 'selesai') {
                $(this).removeClass('btn-light text-gray-500').addClass('btn-success');}
            // $(this).removeClass('btn-secondary').addClass('btn-dark');
            $('#statusFilter').val(status);
            table.ajax.reload();
        });
        });
    </script>

</x-app-layout>
