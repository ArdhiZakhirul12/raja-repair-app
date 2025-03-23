<x-app-layout>
    {{-- <p>jumlah service : {{$bookings->count()}}</p>
    <p>jumlah service garansi : {{$garansi->count()}}</p>
    <p>Total pendapatan : Rp{{number_format($total, 0, ',', '.')}}</p> --}}
    <div class="sm:flex sm:justify-between sm:items-center ml-8">
        <div class="sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Detail Teknisi
            </h1>
        </div>
    </div>
    {{-- <p>{{ $bookings }}</p> --}}

    <div class=" mx-6 my-3">
        <div class="grid grid-cols-9 gap-3">
            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service" total="{{$bookings->count()}}"/>
            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service Garansi" total="{{$garansi->count()}}"/>
            <x-dashboard.dashboard-card-01-teknisi title="Total Pendapatan" total=" Rp{{number_format($total, 0, ',', '.')}}"/>
            
            <x-dashboard.dashboard-card-08-teknisi title="Pelayanan servis per bulan" total="0" :exMonths=$bulanLabels :exSales=$jumlahServis />
          
                <div class="flex flex-col col-span-full sm:col-span-4 xl:col-span-3 bg-white dark:bg-gray-800 shadow-sm rounded-xl p-4">
                    <h2 class="text-xl font-bold mb-4">Data Teknisi</h2>
                 
                    {{-- <p><strong>ID:</strong> {{ $teknisi['id'] }}</p>
                    <p><strong>User ID:</strong> {{ $teknisi['user_id'] }}</p> --}}
                    <div class="flex justify-between mb-4">
                        <p><strong>No HP:</strong></p>
                        <p>{{ $teknisi['no_hp'] }}</p>
                    </div>
                    <div class="flex justify-between mb-4">
                        <p><strong>Nama:</strong></p>
                        <p>{{ $teknisi['nama'] }}</p>
                    </div>
                    <div class="flex justify-between mb-4">
                        <p><strong>Servis:</strong></p>
                        <p>{{ $teknisi['servis'] }}</p>
                    </div>
                    {{-- <div class="flex justify-between mb-4">
                        <p><strong>Created At:</strong></p>
                        <p>{{ $teknisi['created_at'] }}</p>
                    </div> --}}
                    <div class="flex justify-between mb-4">
                        <p><strong>Alamat:</strong></p>
                        <p>{{ $teknisi['alamat'] }}</p>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <p><strong>Rating:</strong></p>
                        <div class="flex items-center">
                            <span class="text-l text-gray-400">
                                @php
                                    $rating = number_format($ratings_per_id["average_rating"], 1);
                                    if ($rating >= 1 && $rating <= 2) {
                                        echo '😞 Tidak Puas';
                                    } elseif ($rating > 2 && $rating < 3) {
                                        echo '😐 Puas';
                                    } elseif ($rating == 3) {
                                        echo '😊 Sangat Puas';
                                    }
                                @endphp
                            </span>
                            <span class="text-xs text-gray-400 pl-3">({{ number_format($ratings_per_id["average_rating"], 1) }})</span>
                        </div>
                    </div>
                    {{-- <p><strong>Updated At:</strong> {{ $teknisi['updated_at'] }}</p> --}}
                </div>
            
        </div>
    </div>
</x-app-layout>

{{-- $bookings bisa buat tabel seluruh servis --}}
{{-- $garansi bisa buat tabel servis garansi --}}