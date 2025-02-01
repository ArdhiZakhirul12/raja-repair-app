<x-app-layout>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #4caf50;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Servis') }}
        </h2>
    </x-slot>

    <div class="py-12">






        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <div
                                    class="flex top-5 right-5 bg-red-200 bg-opacity-50  px-6 py-3 mb-2 rounded shadow-lg z-50 transition-opacity duration-10 border border-red-800">
                                    <img src="{{ asset('images/error_smg.png') }}" alt="error mssg" class="w-6 h-6 mr-4">
                                    <p>{{ $error }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div id="notification"
                    class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 transition-opacity duration-10">
                    <p>{{ session('success') }}</p>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const notification = document.getElementById('notification');
                        if (notification) {
                            notification.classList.add('opacity-0');
                            setTimeout(() => {
                                notification.classList.remove('opacity-0');
                                notification.classList.add('opacity-100');
                            }, 100);

                            setTimeout(() => {
                                notification.classList.remove('opacity-100');
                                notification.classList.add('opacity-0');
                            }, 2000);

                            setTimeout(() => {
                                notification.remove();
                            }, 3000);
                        }
                    });
                </script>
                <style>
                    #notification {
                        transition: opacity 1s ease-in-out;
                    }

                    .opacity-0 {
                        opacity: 0;
                    }

                    .opacity-100 {
                        opacity: 1;
                    }
                </style>
            @endif


            <div class="flex justify-between mb-4 sm:mb-5">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Data Servis
                </h1>
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
                    onclick="document.getElementById('add-service-modal').classList.remove('hidden')">
                    Tambah Servis
                </button>
            </div>


            <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800 dark:text-slate-300">
                <div class="p-6">





                    <!-- Tabel Pelanggan -->
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg overflow-hidden"
                        id="services-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        ID
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>

                                </th>

                                {{-- <th></th> --}}
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Nama
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>

                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        jenis
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">status</th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        harga
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                            </svg></a>
                                    </div>

                                </th>
                                <th scope="col" class="px-6 py-3"x>aksi</th>
                            </tr>
                        </thead>


                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="add-service-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-10 rounded-lg shadow-lg w-200 flex">
            <div class="w-1/2">
                <div class="flex justify-center">
                    <img src="{{ asset('images/create_data.png') }}" alt="Edit Teknisi"
                        class="h-42 w-42 object-cover rounded-l-lg">
                </div>
                <p class="text-center text-sm  px-10 text-gray-400">Pastikan data yang ada masukkan sudah benar dan
                    tidak ada form yang kosong</p>
            </div>
            <div class="w-1/2 p-4">
                <h2 class="text-xl font-semibold mb-4">Tambah Service</h2>
                <form action="{{ route('cs.service.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_sparepart" class="block text-sm font-medium text-gray-400">Nama Service</label>
                        <input type="text" name="nama_servis" id="nama_servis"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="code_sparepart" class="block text-sm font-medium text-gray-400">Kode Sparepart</label>
                        <input type="text" name="code" id="code"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">

                        <label for="jenis_servis" class="block text-sm font-medium text-gray-400">Jenis Service</label>

                        <select name="jenis_servis" id="jenis_servis"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                            <option value="" disabled selected>Pilih jenis service</option>
                            <option value="hardware">Hardware</option>
                            <option value="software">Software</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-400">harga</label>
                        <input type="text" name="harga" id="harga"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                            onclick="document.getElementById('add-service-modal').classList.add('hidden')">Kembali</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        //fungsi untuk memanggil datatable dan mengatur fitur-fitur yang ada
        $(document).ready(function() {
            $('#services-table').DataTable({
                dom: '<"flex mb-4 "<" "f> <""l>   <"flex-grow"B>> t <"row py-4"<"col-md-6"i><"col-md-6 text-end"p>>',
                processing: true,
                serverSide: true,
                ajax: '{{ route('cs.service.getServices') }}',
                columns: [
                    {
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
                   
                    },

                    {
                        data: 'nama_servis',
                        name: 'nama_servis',
                        render: function(data, type, row) {
                            return `<a href="/customer/detail/${row.id}" class="text-black hover:text-black-500 font-bold">${data}</a>`;

                        }
                    },
                    {
                        data: 'jenis_servis',
                        name: 'jenis_servis',
                        render: function(data, type, row) {
                            let textColor = 'text-black';
                            let bgColor = 'bg-yellow-50'; // Default untuk 'software'

                            if (data === 'hardware') {
                                textColor = 'text-purple-700';
                                bgColor = 'bg-purple-50';
                                data = 'Hardware'; // Untuk 'hardware'
                            } else if (data === 'software') {
                                textColor = 'text-yellow-700';
                                bgColor = 'bg-yellow-50';
                                data = 'Software' ;// Untuk 'software'
                            }
                            return `  
                            <td class="px-4 py-2">
                            <span class="${textColor} ${bgColor} px-2 py-1 rounded">${data}</span>
                            </td>`;
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            return `<label class="switch">
                            <input type="checkbox" data-id="${row.id}"
                                onchange="toggleStatus(this)"
                                ${data == 1 ? 'checked' : ''}>
                            <span class="slider round"></span>
                        </label>`;
                        },
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
                        render: function(data) {
                            return `<a href="/customer/edit/${data}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </a>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
                buttons: [


                    {
                        extend: 'excel',
                        text: 'Download'
                    },
                    // {
                    //     extend: 'pdf',
                    //     text: 'PDF'
                    // },
                    // {
                    //     extend: 'print',
                    //     text: 'Print'
                    // }
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




    <script>
        // Fungsi untuk mencari di tabel
        function searchTable() {
            const searchInput = document.getElementById("search").value.toLowerCase();
            const table = document.getElementById("customers-table");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(searchInput)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? "" : "none";
            }
        }

        // Fungsi untuk menyortir tabel berdasarkan kolom
        function sortTable(n) {
            const table = document.getElementById("customers-table");
            let rows = table.rows;
            let switching = true;
            let dir = "asc";
            let switchcount = 0;

            while (switching) {
                switching = false;
                let rowsArray = Array.from(rows).slice(1); // Mengambil semua baris kecuali header
                for (let i = 0; i < rowsArray.length - 1; i++) {
                    let x = rowsArray[i].getElementsByTagName("TD")[n];
                    let y = rowsArray[i + 1].getElementsByTagName("TD")[n];

                    if (dir === "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase() ||
                        dir === "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        rowsArray[i].parentNode.insertBefore(rowsArray[i + 1], rowsArray[i]);
                        switching = true;
                        switchcount++;
                        break;
                    }
                }

                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    </script>
    <script>
        function toggleStatus(checkbox) {
            const sparepartId = checkbox.getAttribute('data-id');
            const newStatus = checkbox.checked ? '1' : '0';

            // Kirim data ke server menggunakan fetch atau AJAX
            fetch("{{ route('cs.service.updateStatus') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: newStatus,
                        id: sparepartId
                    })

                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notification = document.createElement('div');
                        notification.id = 'notification';
                        notification.className =
                            'fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 transition-opacity duration-10';
                        notification.innerHTML = `<p>${data.message}</p>`;
                        document.body.appendChild(notification);

                        setTimeout(() => {
                            notification.classList.add('opacity-0');
                        }, 2000);

                        setTimeout(() => {
                            notification.remove();
                        }, 3000);
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
        }
    </script>
</x-app-layout>
