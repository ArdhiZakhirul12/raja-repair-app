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
               
                <select class="border rounded p-2">
                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button class="bg-blue-500 text-white rounded p-2 ml-2">Change Status</button>
                <hr class="my-4 px-4">
                <h1 class="font-bold my-3">Pelanggan</h1>
                <h1 class="mb-3"><i class="fas fa-user mr-2 text-blue-500"></i> {{ $booking->customer->nama }}</h1>
                <h1 class="mb-3"><i class="fas fa-phone mr-2 text-blue-500"></i> {{ $booking->no_hp_alternatif }}</h1>
                <h1 class="mb-3"><i class="fas fa-shield-alt mr-2 text-blue-500"></i> Klaim Garansi : @if($booking->claim) Iya @else Tidak @endif</h1>
            </div>

         
           


        </div>
    </div>



</x-app-layout>
