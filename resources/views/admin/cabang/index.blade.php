<x-app-layout>
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
    @if ($errors->any())
        <div id="notification"
            class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded shadow-lg z-50 transition-opacity duration-10">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                    }, 10000);

                    setTimeout(() => {
                        notification.remove();
                    }, 10000);
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
        <h4 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100  font-bold">
            Data Cabang
        </h4>
        <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
            onclick="document.getElementById('add-customer-modal').classList.remove('hidden')">
            Tambah Cabang
        </button>
    </div>
    <div id="add-customer-modal"
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
                <h2 class="text-xl font-semibold mb-4">Tambah Cabang</h2>
                <form action="{{ route('admin.cabang.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_cabang" class="block text-sm font-medium text-gray-400">Nama Cabang</label>
                        <input type="text" name="nama_cabang" id="nama_cabang"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-400">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="no_hp" class="block text-sm font-medium text-gray-400">No WA</label>
                        <input type="text" name="no_hp" id="no_hp"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-400">Alamat</label>
                        <textarea name="alamat" id="alamat" class="mt-1 p-2 w-full border border-gray-300 rounded" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-400">email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-400">password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                            onclick="document.getElementById('add-customer-modal').classList.add('hidden')">Kembali</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
