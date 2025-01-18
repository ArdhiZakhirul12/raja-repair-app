<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Teknisi') }}
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
                                <img src="{{ asset('images/error_smg.png') }}" alt="error mssg" class="w-6 h-6 mr-4" >
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
        
        <div class="mb-4 sm:mb-5 ">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Data Teknisi
            </h1>
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 mr-4" 
            onclick="document.getElementById('add-teknisi-modal').classList.remove('hidden')">
            Tambah Teknisi
        </button>
        </div>
            <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800 dark:text-slate-300">
                
                <div class="p-6">
                   
                  
                 

                    <!-- Tabel Pelanggan -->
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-lg overflow-hidden" id="teknisi-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Nama
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                          </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        No HP
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                          </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Alamat
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                          </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">

                                    <div class="flex items-center">
                                        Total Servis
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                          </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">aksi</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($teknisis as $teknisi)
                                <tr>
                                    <td class="border px-4 py-2">{{ $teknisi->nama }}</td>
                                    <td class="border px-4 py-2">{{ $teknisi->no_hp }}</td>
                                    <td class="border px-4 py-2">{{ $teknisi->alamat }}</td>
                                    <td class="border px-4 py-2">{{ $teknisi->servis }}</td>
                                    <td class="border px-4 py-2">
                                        <button class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700"
                                            data-id="{{ $teknisi->id }}" 
                                            data-nama="{{ $teknisi->nama }}"
                                            data-no_hp="{{ $teknisi->no_hp }}"
                                            data-alamat="{{ $teknisi->alamat }}"
                                             onclick="openEditModal(this)">
                                            edit teknisi
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="add-teknisi-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Tambah Teknisi</h2>
            <form action="{{ route('cs.teknisi.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">No WA</label>
                    <input type="text" name="no_hp" id="no_hp"
                        class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" class="mt-1 p-2 w-full border border-gray-300 rounded" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                        onclick="document.getElementById('add-teknisi-modal').classList.add('hidden')">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-teknisi-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 flex">
            <div class="w-1/3">
                <img src="{{ asset('images/edit_teknisi.png') }}" alt="Edit Teknisi" class="h-full w-full object-cover rounded-l-lg">
            </div>
            <div class="w-2/3 p-4">
                <h2 class="text-xl font-semibold mb-4">Edit Teknisi</h2>
                <form action="{{ route('cs.teknisi.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">No Hp</label>
                        <input type="text" name="no_hp" id="no_hp"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                            onclick="document.getElementById('edit-teknisi-modal').classList.add('hidden')">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>

        //fungsi untuk memanggil datatable dan mengatur fitur-fitur yang ada
        $(document).ready(function() {
    $('#teknisi-table').DataTable({
        dom: '<"flex mb-4 "<" "f> <""l>   <"flex-grow"B>> t <"row py-4"<"col-md-6"i><"col-md-6 text-end"p>>',
        processing: true,
        serverSide: true,
        ajax: '{{ route("cs.teknisi.getTechnicians") }}',
        columns: [
            {
                data: 'id',
                render: function (data) {
                    return `<input type="checkbox" class="row-checkbox" value="${data}">`;
                },
                orderable: false,
                searchable: false
            },
           
            { data: 'nama', name: 'nama', render: function(data, type, row) {
                return `<a href="/teknisi/detail/${row.id}" class="text-black hover:text-black-500 font-bold">${data}</a>`;
        
            }},
            { data: 'no_hp', name: 'no_hp' },
            { data: 'alamat', name: 'alamat' },
            { data: 'servis', name: 'servis' },
           

         
            {
    data: 'id',
    render: function (data, type, row) {
        return `<button class="text-blue-500 hover:text-blue-700" 
                                            data-id="${row.id}" 
                                            data-nama="${row.nama}"
                                            data-no_hp="${row.no_hp}"
                                            data-alamat="${row.alamat}"
                                             onclick="openEditModal(this)">
                    <i class="fas fa-edit"></i>
                </button>`;
    },
    orderable: false,
    searchable: false
}
        ],
        buttons: [


{ extend: 'excel', text: 'Excel' },
{ extend: 'pdf', text: 'PDF' },
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
pageLength: 10, 
order: [[0, 'desc']], 
    });
});
</script>




    

    <script>
        function openEditModal(button) {
            // Ambil data dari tombol yang diklik
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const no_hp = button.getAttribute('data-no_hp');
            const alamat = button.getAttribute('data-alamat');

            // Tampilkan modal
            const modal = document.getElementById('edit-teknisi-modal');
            modal.classList.remove('hidden');

            // Isi data di modal
            modal.querySelector('#id').value = id;
            modal.querySelector('#nama').value = nama;
            modal.querySelector('#no_hp').value = no_hp;
            modal.querySelector('#alamat').value = alamat;
        }
    </script>

    <script>
        // Fungsi untuk mencari di tabel
        function searchTable() {
            const searchInput = document.getElementById("search").value.toLowerCase();
            const table = document.getElementById("add-teknisi-table");
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
            const table = document.getElementById("add-teknisi-table");
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
</x-app-layout>
