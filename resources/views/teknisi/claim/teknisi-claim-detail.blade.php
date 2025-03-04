<x-app-layout>
    @if (session()->has('msg'))
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50" id="popup">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Notifikasi</h3>
                <button onclick="document.getElementById('popup').style.display='none'" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="mt-4 text-gray-700">{{ session('msg') }}</p>
            <div class="mt-6 flex justify-end">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endif
    {{-- @dd($booking->id) --}}
    <div class="sm:flex sm:justify-between sm:items-center ml-8">
        <div class="sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Detail Claim Garansi
            </h1>
            <h1 class="text-xl text-blue-500">#{{ $claim->booking->kode_pesanan }}</h1>
        </div>

        
    <div class="flex flex-col bg-white rounded shadow p-3 items-center my-2 mr-4 ">
        <h1 class="text-l mb-2 text-gray-400">ANTRIAN</h1>
        <h1 class="text-xl font-bold">{{ $claim->no_antrian }}</h1>
    </div>
    </div>

    <div class=" mx-6 my-3">
        <div class="flex">
            <div class="w-1/2 bg-white rounded shadow p-4 mr-4">
                <h1 class="text-xl font-bold mb-4">Data Handphone</h1>
                
                
                <div class="flex space-x-3 items-center">
                    <img src="{{ asset('images/Windows_Phone.svg') }}" alt="logo" class="w-8 ">
                    <h1>{{ $claim->booking->hpModel->hpMerk->merk }},</h1>
                    <h1>{{ $claim->booking->hpModel->model }}</h1>
                </div>
                <hr class="my-4 px-4">
                <h1 class="font-bold my-2">Kendala :</h1>
                
                <h1>{{ $claim->kendala }}</h1>
                <h1 class="font-bold my-2 pt-2">Keterangan :</h1>
                <h1>{{ $claim->keterangan }}</h1>
                <h1 class="font-bold my-2 pt-2">Sparepart :</h1>
                @foreach ($claim->booking['sparepart_booking'] as $sparepart)
                    <p>{{ $sparepart->sparepart->nama_sparepart }}</p>
                @endforeach
            </div>
            <div class="w-1/2 bg-white rounded shadow p-4">
               
                <form method="POST" action="{{route('teknisi.claim.update', ['id'=> $claim->id])}}">
                    @csrf
                    @method('PUT')
                    @if ($claim['status'] == 'diproses')   
                    <input type="hidden" name='status' value="dikerjakan">
                    <button type="submit" class="bg-blue-500 text-white rounded p-2 ml-2">Kerjakan Pesanan ini</button>
                    @elseif($claim['status'] == 'dikerjakan')
                    <input type="hidden" name="status" value="teknisi-selesai">
                    <button type="submit" class="bg-blue-500 text-white rounded p-2 ml-2">Selesaikan pesanan ini</button>
                    @endif
                </form>
                
                {{-- @if (in_array($booking['status'], ['teknisi-selesai', 'selesai']))
                {{ \Carbon\Carbon::parse($booking->workTimeBooking->end)->diffForHumans(\Carbon\Carbon::parse($booking->workTimeBooking->start),false) }}
                    
                @endif --}}
                
                <hr class="my-4 px-4">
                <h1 class="font-bold my-3">Pelanggan</h1>
                <h1 class="mb-3"><i class="fas fa-user mr-2 text-blue-500"></i> {{ $claim->booking->customer->nama }}</h1>
                <h1 class="mb-3"><i class="fas fa-phone mr-2 text-blue-500"></i> {{ $claim->booking->no_hp_alternatif }}</h1>
                {{-- <h1 class="mb-3"><i class="fas fa-shield-alt mr-2 text-blue-500"></i> Klaim Garansi : @if($booking->claim) Iya @else Tidak @endif</h1> --}}
            </div>

         
           


        </div>
    </div>



</x-app-layout>
