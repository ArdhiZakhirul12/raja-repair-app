<x-app-layout>
    {{-- @dd($booking->id) --}}
    <div class="sm:flex sm:justify-between sm:items-center ml-8">
        <div class="sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Detail Pemesanan
            </h1>
            <h1 class="text-xl text-blue-500">#{{ $booking->kode_pesanan }}</h1>
        </div>


        <div class="flex flex-col bg-white rounded shadow p-3 items-center my-2 mr-4 ">
            <h1 class="text-l mb-2 text-gray-400">ANTRIAN</h1>
            <h1 class="text-xl font-bold">{{ $booking->nomor_antrian }}</h1>
        </div>
    </div>

    <div class="flex flex-wrap gap-4 p-4">

        <div class="w-full md:w-1/3 bg-white rounded shadow p-4">
            <h1 class="text-xl font-bold mb-4">Data Handphone</h1>


            <div class="flex space-x-3 items-center">
                <img src="{{ asset('images/Windows_Phone.svg') }}" alt="logo" class="w-8 ">
                <h1>{{ $booking->hpModel->hpMerk->merk }},</h1>
                <h1>{{ $booking->hpModel->model }}</h1>
            </div>
            <hr class="my-4 px-4">
            <h1 class="font-bold my-2">Kendala :</h1>

            <h1>{{ $booking->kendala }}</h1>
            <h1 class="font-bold my-2 pt-2">Keterangan :</h1>
            <h1>{{ $booking->keterangan }}</h1>
            <h1 class="font-bold my-2 pt-2">Sparepart :</h1>
            @foreach ($booking['sparepart_booking'] as $sparepart)
                <p>{{ $sparepart->sparepart->nama_sparepart }}</p>
            @endforeach
        </div>
        <div class="w-full md:w-1/3 bg-white rounded shadow p-4">
            @if ($booking['status'] == 'diproses')
                {{-- <input type="hidden" name='status' value="dikerjakan"> --}}
                <button class="bg-yellow-500 text-white rounded p-2 ml-2" data-action="mulai"
                    onclick="openServiceModal(this)">
                    Mulai pengerjaan
                </button>
            @elseif($booking['status'] == 'dikerjakan')
                {{-- <input type="hidden" name="status" value="teknisi-selesai"> --}}
                <!-- Tombol Batalkan -->
                <button class="bg-red-500 text-white rounded p-2 ml-2" data-action="batal"
                    onclick="openServiceModal(this)">
                    Batalkan pesanan ini
                </button>

                <!-- Tombol Selesaikan -->
                <button class="bg-blue-500 text-white rounded p-2 ml-2" data-action="selesai"
                    onclick="openServiceModal(this)">
                    Selesaikan pesanan ini
                </button>
            @endif


            @if (in_array($booking['status'], ['teknisi-selesai', 'selesai']))
                @php
                    $duration = \Carbon\Carbon::parse($booking->workTimeBooking->end)->diff(
                        \Carbon\Carbon::parse($booking->workTimeBooking->start),
                    );
                    $formattedDuration = '';
                    if ($duration->h > 0) {
                        $formattedDuration .= $duration->h . ' jam ';
                    }
                    if ($duration->i > 0) {
                        $formattedDuration .= $duration->i . ' menit ';
                    }
                    if ($duration->s > 0) {
                        $formattedDuration .= $duration->s . ' detik';
                    }
                @endphp
                Selesai dalam {{ $formattedDuration }}
            @endif
            {{-- @dd($booking) --}}
            <hr class="my-4 px-4">
            <h1 class="font-bold my-3">Pelanggan</h1>
            <h1 class="mb-3"><i class="fas fa-user mr-2 text-blue-500"></i> {{ $booking->customer->nama }}</h1>
            {{-- <h1 class="mb-3"><i class="fas fa-phone mr-2 text-blue-500"></i> {{ $booking->users->no_hp }}</h1> --}}
            <h1 class="mb-3"><i class="fas fa-shield-alt mr-2 text-blue-500"></i> Klaim Garansi : @if ($booking->claim)
                    Iya
                @else
                    Tidak
                @endif
            </h1>
        </div>

    </div>

    {{-- <button onclick="document.getElementById('start-service-modal').classList.remove('hidden')">Testing Dialog</button> --}}

    <div id="start-service-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-current p-10 rounded-lg shadow-lg w-full max-w-xl">
            <h2 id="modal-title" class="text-xl font-semibold mb-4"></h2>
            <h2 id="modal-message" class="text-l mb-4"></h2>
        
            <form method="POST" action="{{ route('teknisi.booking.update', ['id' => $booking->id]) }}">
                @csrf
                @method('PUT')
        
                <input type="hidden" name="status" id="modal-status">
        
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                        onclick="document.getElementById('start-service-modal').classList.add('hidden')">
                        Tidak
                    </button>
                    <button type="submit" class="bg-blue-500 text-white rounded px-4 ml-2">Ya</button>
                </div>
            </form>
            {{-- <div class="flex justify-end">
            <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                onclick="document.getElementById('start-service-modal').classList.add('hidden')">Tidak</button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Ya</button>
        </div> --}}


        </div>
    </div>
    <script>
        function openServiceModal(button) {
            const action = button.getAttribute('data-action');
            const modal = document.getElementById('start-service-modal');
        
            const title = modal.querySelector('#modal-title');
            const message = modal.querySelector('#modal-message');
            const statusInput = modal.querySelector('#modal-status');
        
            let titleText = '';
            let messageText = '';
            let statusValue = '';
        
            switch (action) {
                case 'batal':
                    titleText = 'Batalkan Pesanan';
                    messageText = 'Apa anda yakin ingin membatalkan pesanan ini?';
                    statusValue = 'teknisi-batal';
                    break;
                case 'mulai':
                    titleText = 'Mulai Pengerjaan';
                    messageText = 'Apa anda yakin memulai pengerjaan service?';
                    statusValue = 'dikerjakan';
                    break;
                case 'selesai':
                    titleText = 'Selesaikan Pengerjaan';
                    messageText = 'Apa anda yakin menyelesaikan pengerjaan service?';
                    statusValue = 'teknisi-selesai';
                    break;
            }
        
            title.textContent = titleText;
            message.textContent = messageText;
            statusInput.value = statusValue;
        
            modal.classList.remove('hidden');
        }
        </script>
        

</x-app-layout>
