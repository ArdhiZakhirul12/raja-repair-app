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

    <div class=" mx-6 my-3">
        <div class="flex">
            <div class="w-1/2 bg-white rounded shadow p-4 mr-4">
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
            <div class="w-1/2 bg-white rounded shadow p-4">
               
                <form method="POST" action="{{route('teknisi.booking.update', ['id'=> $booking->id])}}">
                    @csrf
                    @method('PUT')
                    @if ($booking['status'] == 'diproses')   
                    <input type="hidden" name='status' value="dikerjakan">
                    <button type="submit" class="bg-blue-500 text-white rounded p-2 ml-2">Kerjakan Pesanan ini</button>
                    @elseif($booking['status'] == 'dikerjakan')
                    <input type="hidden" name="status" value="teknisi-selesai">
                    <button type="submit" class="bg-blue-500 text-white rounded p-2 ml-2">Selesaikan pesanan ini</button>
                    @endif
                </form>
                
                @if (in_array($booking['status'], ['teknisi-selesai', 'selesai']))
                @php
                    $duration = \Carbon\Carbon::parse($booking->workTimeBooking->end)->diff(\Carbon\Carbon::parse($booking->workTimeBooking->start));
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
                
                <hr class="my-4 px-4">
                <h1 class="font-bold my-3">Pelanggan</h1>
                <h1 class="mb-3"><i class="fas fa-user mr-2 text-blue-500"></i> {{ $booking->customer->nama }}</h1>
                <h1 class="mb-3"><i class="fas fa-phone mr-2 text-blue-500"></i> {{ $booking->no_hp_alternatif }}</h1>
                <h1 class="mb-3"><i class="fas fa-shield-alt mr-2 text-blue-500"></i> Klaim Garansi : @if($booking->claim) Iya @else Tidak @endif</h1>
            </div>

         
           


        </div>
    </div>



</x-app-layout>
