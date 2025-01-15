<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pelanggan') }}
        </h2>
    </x-slot> --}}

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
                    Data Pelanggan
                </h1>
            </div>
            <div class="overflow-hidden shadow-xl sm:rounded-lg bg-white dark:bg-gray-800 dark:text-slate-300">
                <div class="p-6">
                    <div class="flex justify-between mb-4">
                        <input type="text" id="search" placeholder="Cari pelanggan..." class="p-2 border border-gray-300 rounded" onkeyup="searchTable()">
                        <div class="flex items-center">
                            <button 
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 mr-4"
                                onclick="document.getElementById('add-customer-modal').classList.remove('hidden')"
                            >
                                Tambah Pelanggan
                            </button> 
                            <span class="text-gray-700 font-medium dark:text-slate-300" >
                                Total Pelanggan : {{ count($customers) }}
                            </span>            
                        </div>      
                    </div>
                    

                    <hr class="my-4 border-t border-gray-300">
                    

                    <!-- Tabel Pelanggan -->
                    <table class="min-w-full table-auto" id="customers-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left bg-white border" onclick="sortTable(0)">Nama</th>
                                <th class="px-4 py-2 text-left bg-white border" onclick="sortTable(1)">No HP</th>                                
                                <th class="px-4 py-2 text-left bg-white border" onclick="sortTable(2)">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="border px-4 py-2">{{ $customer->nama }}</td>                                    
                                    <td class="border px-4 py-2">{{ $customer->no_hp }}</td>
                                    <td class="border px-4 py-2">{{ $customer->alamat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="add-customer-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Tambah Pelanggan</h2>
            <form action="{{ route('cs.customer.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">No WA</label>
                    <input type="text" name="no_hp" id="no_hp" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" id="alamat" class="mt-1 p-2 w-full border border-gray-300 rounded" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2" onclick="document.getElementById('add-customer-modal').classList.add('hidden')">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
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
</x-app-layout>
