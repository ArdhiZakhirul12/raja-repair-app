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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <button 
                        class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700"
                        onclick="document.getElementById('add-service-modal').classList.remove('hidden')"
                    >
                        Tambah servis
                    </button> 
                    <span class="ml-auto text-gray-700 font-medium">
                        Total servis: {{ count($services) }}
                    </span>              
                    <!-- Pencarian -->
                    <input type="text" id="search" placeholder="Cari servis..." class="mb-4 p-2 border border-gray-300 rounded w-full" onkeyup="searchTable()">

                    <!-- Tabel Pelanggan -->
                    <table class="min-w-full table-auto" id="customers-table">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left" onclick="sortTable(0)">Nama</th>
                                <th class="px-4 py-2 text-left" onclick="sortTable(1)">jenis</th>                                
                                <th class="px-4 py-2 text-left" onclick="sortTable(2)">status</th>                                
                                <th class="px-4 py-2 text-left" onclick="sortTable(3)">harga</th>
                                <th class="px-4 py-2 text-left" onclick="sortTable(3)">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td class="border px-4 py-2">{{ $service->nama_servis }}</td>                                    
                                    <td class="border px-4 py-2">{{ $service->jenis_servis }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Toggle Switch -->
                                        <label class="switch">
                                            <input type="checkbox" data-id="{{ $service->id }}"
                                                onchange="toggleStatus(this)"
                                                {{ $service->status == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="border px-4 py-2">{{ $service->harga }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="add-service-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Tambah Service</h2>
            <form action="{{ route('cs.service.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_sparepart" class="block text-sm font-medium text-gray-700">Nama Service</label>
                    <input type="text" name="nama_servis" id="nama_servis"
                        class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="jenis_servis" class="block text-sm font-medium text-gray-700">Jenis Service</label>
                    <select name="jenis_servis" id="jenis_servis" 
                        class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                        <option value="" disabled selected>Pilih jenis service</option>
                        <option value="hardware">Hardware</option>
                        <option value="software">Software</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700">harga</label>
                    <input type="text" name="harga" id="harga"
                        class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                        onclick="document.getElementById('add-service-modal').classList.add('hidden')">Batal</button>
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
                        alert(data.message);
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