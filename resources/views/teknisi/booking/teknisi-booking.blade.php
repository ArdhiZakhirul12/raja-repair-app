<x-app-layout>

    <div class="sm:flex sm:justify-between sm:items-center ml-8">
        <div class="sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Booking Teknisi
            </h1>
        </div>
    </div>
    {{-- <p>{{ $bookings[0]}}</p> --}}
    {{-- <p>{{ $bookings[0]->hpModel->model }}</p> --}}
    {{-- @dd($bookings->hpModel) --}}
    <div x-data="{
        selectedStatus: window.location.pathname.split('/').pop() || 'diproses'
    }" class="p-4">
        <div class=" mx-6 my-3">
            <div class="bg-white rounded-lg shadow overflow-hidden l mx-auto p-4 ">

                <div class="bg-gray w-fit mb-4 rounded-lg">

                    <div
                        class="flex flex-wrap gap-y-2 gap-x-4 px-2 py-2 bg-gray-100 dark:bg-gray-700/60 w-auto rounded-lg">

                        <button
                            @click="window.location.href='{{ route('teknisi.booking.index', ['status' => 'diproses']) }}'"
                            :class="selectedStatus === 'diproses' ? 'bg-white ' : 'text-gray-400'"
                            class="px-4 py-2 rounded">
                            Diproses
                        </button>

                        <button
                            @click="window.location.href='{{ route('teknisi.booking.index', ['status' => 'dikerjakan']) }}'"
                            :class="selectedStatus === 'dikerjakan' ? 'bg-white ' : 'text-gray-400'"
                            class="px-4 py-2 rounded">Dikerjakan</button>

                        <button
                            @click="window.location.href='{{ route('teknisi.booking.index', ['status' => 'teknisi-selesai']) }}'"
                            :class="selectedStatus === 'teknisi-selesai' ? 'bg-white ' : 'text-gray-400'"
                            class="px-4 py-2 rounded">Teknisi Selesai</button>
                        <button
                            @click="window.location.href='{{ route('teknisi.booking.index', ['status' => 'teknisi-batal']) }}'"
                            :class="selectedStatus === 'teknisi-batal' ? 'bg-white ' : 'text-gray-400'"
                            class="px-4 py-2 rounded">Teknisi batal</button>

                        <button
                            @click="window.location.href='{{ route('teknisi.booking.index', ['status' => 'selesai']) }}'"
                            :class="selectedStatus === 'selesai' ? 'bg-white ' : 'text-gray-400'"
                            class="px-4 py-2 rounded">Selesai</button>

                    </div>
                </div>

                @foreach ($bookings as $index => $booking)
                    <div x-show="selectedStatus === '{{ $booking->status }}'">
                        <div class="border rounded bg-white flex items-center mb-4">
                            <!-- Bagian Antrian -->
                            <div class="p-4 text-center flex flex-col items-center">
                                <h1 class="text-l mb-2">ANTRIAN</h1>
                                <h1 class="text-2xl font-bold">{{ $booking->nomor_antrian }}</h1>
                            </div>

                            <!-- Garis Pemisah -->
                            <div class="border-l border-gray-300 self-stretch my-3"></div>


                            <!-- Bagian Detail Booking -->
                            <div class="w-2/3 p-4 flex items-center">
                                <div class="mr-6">
                                    <h1 class="text-2xl font-bold mb-3">{{ $booking['kode_pesanan'] }}</h1>
                                    <p class="text-gray-400">{{ $booking->hpModel->hpMerk->merk }},
                                        {{ $booking->hpModel->model }}</p>
                                </div>
                                <div class="flex flex-col items-start">
                                    <h1 class="text-l mb-3 text-gray-400">{{ $booking->customer->nama }}</h1>
                                    <h1 class="text-l rounded p-2 text-center"
                                        :class="{
                                            'bg-blue-500 text-white': '{{ $booking['status'] }}'
                                            === 'diproses',
                                            'bg-yellow-500 text-white': '{{ $booking['status'] }}'
                                            === 'dikerjakan',
                                            'bg-green-500 text-white': '{{ $booking['status'] }}'
                                            === 'teknisi-selesai',
                                            'bg-gray-500 text-white': '{{ $booking['status'] }}'
                                            === 'selesai'
                                        }">
                                        {{ $booking['status'] }}
                                    </h1>

                                </div>
                            </div>

                            <!-- Bagian Edit Button -->
                            <div class="w-1/3 p-4 flex justify-end">
                                <button class="bg-white hover:bg-blue-700 font-bold py-2 px-4 rounded shadow"
                                    onclick="window.location.href='{{ route('teknisi.booking.show', $booking->id) }}'">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4">
                    {{ $bookings->links() }}
                </div>
            </div>



        </div>
    </div>
    <script>
        console.log("Selected Status:", window.location.pathname.split('/').pop());
    </script>
</x-app-layout>
