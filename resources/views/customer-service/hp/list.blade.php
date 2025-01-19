<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Kelola Merk dan Model HP</h1>

        <!-- Alert -->
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

            <div class="grid grid-cols-2 gap-8">
                <!-- Merk HP -->
                <div class="bg-white p-6 rounded-lg shadow-md">

                    <div class="flex justify-between mb-4 sm:mb-5">
                        <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                            Data Merk HP
                        </h1>
                        <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
                            onclick="document.getElementById('add-merk-modal').classList.remove('hidden')">
                            Tambah Merk HP
                        </button>
                    </div>
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merks as $merk)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $merk->merk }}</td>
                                <td class="border px-4 py-2">
                                    <a href="" class="text-yellow-500">Edit</a>
                                        {{-- <form action="" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                        </form> --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Model HP -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between mb-4 sm:mb-5">
                        <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                            Data Model HP
                        </h1>
                        <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
                            onclick="document.getElementById('add-model-modal').classList.remove('hidden')">
                            Tambah Model HP
                        </button>
                    </div>
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Model</th>
                                <th class="border px-4 py-2">Merk</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $model)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration}}</td>
                                <td class="border px-4 py-2">{{ $model->model }}</td>
                                <td class="border px-4 py-2">{{ $model->hpMerk->merk }}</td>
                                <td class="border px-4 py-2">
                                    <a href="" class="text-yellow-500">Edit</a>
                                    {{-- <form action="{{ route('hp.destroy', $model->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div id="add-merk-modal"
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
                    <h2 class="text-xl font-semibold mb-4">Tambah Merk HP</h2>
                    <form action="{{ route('cs.hp.merkStore') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="merk" class="block text-sm font-medium text-gray-400">Merk HP</label>
                            <input type="text" name="merk" id="merk"
                                class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                                onclick="document.getElementById('add-merk-modal').classList.add('hidden')">Kembali</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="add-model-modal"
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
                    <h2 class="text-xl font-semibold mb-4">Tambah Model HP</h2>
                    <form action="{{ route('cs.hp.modelStore') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="merk" class="block text-sm font-medium text-gray-400">Merk HP</label>
                            <select name="hp_merk_id" id="merk" class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                                <option value="" disabled selected>Pilih Merk HP</option>
                                @foreach ($merks as $merk)
                                    <option value="{{ $merk->id }}">{{ $merk->merk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="model" class="block text-sm font-medium text-gray-400">Model HP</label>
                            <input type="text" name="model" id="model"
                                class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                                onclick="document.getElementById('add-model-modal').classList.add('hidden')">Kembali</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
