<x-app-layout>


    {{-- @foreach ($spendings as $spending)
    <P>{{$spending}}</P>        
    @endforeach --}}
    {{-- <p>{{ $spending }}</p> --}}
    <div class="sm:flex sm:justify-between sm:items-center ml-8">
        <div class="sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Detail Pengeluaran
            </h1>
        </div>
    </div>
    <div class="bg-white rounded shadow p-9 m-6 ">

        <form>

            <div class="flex mb-4">
                <div class="flex-1 mr-4">
                    <label for="dokumen" class="block text-gray-700 flex items-center">
                        <i class="fas fa-file-alt text-blue-500 mr-2"></i> Dokumen:
                    </label>
                    <input type="text" id="dokumen" name="dokumen" value="{{ $spending['dokumen'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex-1 mr-4">
                    <label for="referensi" class="block text-gray-700 flex items-center">
                        <i class="fas fa-link text-green-500 mr-2"></i> Referensi:
                    </label>
                    <input type="text" id="referensi" name="referensi" value="{{ $spending['referensi'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex-1">
                    <label for="tanggal" class="block text-gray-700 flex items-center">
                        <i class="fas fa-calendar-alt text-red-500 mr-2"></i> Tanggal:
                    </label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ $spending['tanggal'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="flex mb-4">
                <div class="flex-1 mr-4">
                    <label for="metode_pembayaran_id" class="block text-gray-700 flex items-center">
                        <i class="fas fa-credit-card text-purple-500 mr-2"></i> Metode Pembayaran ID:
                    </label>
                    <input type="text" id="metode_pembayaran_id" name="metode_pembayaran_id"
                        value="{{ $spending['metode_pembayaran_id'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex-1 mr-4">
                    <label for="harga" class="block text-gray-700 flex items-center">
                        <i class="fas fa-dollar-sign text-yellow-500 mr-2"></i> Harga:
                    </label>
                    <input type="text" id="harga" name="harga" value="{{ $spending['harga'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex-1">
                    <label for="jumlah" class="block text-gray-700 flex items-center">
                        <i class="fas fa-sort-numeric-up text-teal-500 mr-2"></i> Jumlah:
                    </label>
                    <input type="text" id="jumlah" name="jumlah" value="{{ $spending['jumlah'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block text-gray-700 flex items-center">
                    <i class="fas fa-comment-dots text-indigo-500 mr-2"></i> Keterangan:
                </label>
                <textarea id="keterangan" name="keterangan" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $spending['keterangan'] }}</textarea>
            </div>
            <div class="flex">
                <div class="flex-1 mr-4">
                    <label for="created_at" class="block text-gray-700 flex items-center">
                        <i class="fas fa-clock text-pink-500 mr-2"></i> Created At:
                    </label>
    
                    <input type="text" id="created_at" name="created_at" value="{{ $spending['created_at'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        readonly>
                </div>
                <div class="flex-1">
                    <label for="updated_at" class="block text-gray-700 flex items-center">
                        <i class="fas fa-sync-alt text-orange-500 mr-2"></i> Updated At:
                    </label>
                    <input type="text" id="updated_at" name="updated_at" value="{{ $spending['updated_at'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        readonly>
                </div>
            </div>
           
        </form>
    </div>



</x-app-layout>
