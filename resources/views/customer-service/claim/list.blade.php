<x-app-layout>

    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-4 sm:mb-5">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Data claim garansi
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
                                    Total Claim
                                    <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                         
                            <th scope="col" class="px-6 py-3"></th>

                        </tr>
                    </thead>
                    <tbody>
                          
                        @foreach ($garansi as $item)  
                        <tr>
                            <td>
                                {{$item->booking->kode_pesanan}}
                                
                            </td>
                            <td>
                                
                                {{$item->booking->customer->nama}}
                            </td>
                            <td>
                                
                                {{$item->booking->claim}}
                            </td>
                            <td>
                                
                                {{$item->status}}
                            </td>
                            <td>
                                
                                <button>detail</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</x-app-layout>
