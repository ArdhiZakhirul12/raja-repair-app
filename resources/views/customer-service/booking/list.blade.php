<x-app-layout>
    
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-4 sm:mb-5">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Data Transaksi
            </h1>
            {{-- <button   class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
        onclick="document.getElementById('add-sparepart-modal').classList.remove('hidden')">
        Tambah Sparepart
    </button> --}}
        </div>
        <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800 dark:text-slate-300">
            <div class="p-6">




                <!-- Tabel Pelanggan -->
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg overflow-hidden"
                    id="booking-table">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">ID</th>
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
                                    No Hp
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">Imei</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">action</th>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <script>
        //fungsi untuk memanggil datatable dan mengatur fitur-fitur yang ada
        $(document).ready(function() {
            $('#booking-table').DataTable({
                dom: '<"flex mb-4 "<" "f> <""l>   <"flex-grow"B>> t <"row py-4"<"col-md-6"i><"col-md-6 text-end"p>>',
                processing: true,
                serverSide: true,
                ajax: '{{ route('cs.booking.getBooking') }}',
                columns: [{
                        data: 'id',
                        render: function(data) {
                            return `<input type="checkbox" class="row-checkbox" value="${data}">`;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row) {
                            return `<a href="/teknisi/detail/${row.id}" class="text-black hover:text-black-500 font-bold">${data}</a>`;

                        }
                    },

         
                    {
                        data: 'kode_pesanan',
                        name: 'kode_pesanan'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id',
                        render: function(data, type, row) {
                            return `<a href="/teknisi/detail/${row.id}" class="text-black hover:text-black-500 font-bold">${data}</a>`;

                        }
                    },
                    {
                        data: 'no_hp_alternatif',
                        name: 'no_hp_alternatif',
                      
                    },
                    {
                        data: 'imei',
                        name: 'imei'
                    },

                    {
                        data: 'status',
                        name: 'status',
                      
                    },
             
            


                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return `<button class="text-blue-500 hover:text-blue-700" 
                                            data-id="${row.id}" 
                                            data-nama="${row.nama_sparepart}"
                                            data-harga="${row.harga}"
                                            onclick="window.location.href='{{ route('cs.booking.displayDetail') }}'">
                    <i class="fas fa-edit"></i>
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
                    {
                        extend: 'pdf',
                        text: 'PDF'
                    },
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
    </script>

</x-app-layout>
