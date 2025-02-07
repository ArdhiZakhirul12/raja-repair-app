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
    <p>{{ $teknisi }}</p>

    <div class="flex justify-center m-6">
        <div class="grid grid-cols-9 gap-3">
            <x-dashboard.dashboard-card-01 title="Jumlah Service" total="{{$bookings->count()}}"/>
            <x-dashboard.dashboard-card-01 title="Jumlah Service Garansi" total="{{$garansi->count()}}"/>
            <x-dashboard.dashboard-card-01 title="Total Pendapatan" total=" Rp{{number_format($total, 0, ',', '.')}}"/>
            <x-dashboard.dashboard-card-08 title="Pelayanan servis per bulan" total="0" :exMonths="$exMonths" :exSales="$exSales" />
          
                <div class="flex flex-col col-span-full sm:col-span-4 xl:col-span-3 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
                    <h2 class="text-xl font-bold mb-4">Detail Teknisi</h2>
                    <p><strong>ID:</strong> {{ $teknisi['id'] }}</p>
                    <p><strong>User ID:</strong> {{ $teknisi['user_id'] }}</p>
                    <p><strong>No HP:</strong> {{ $teknisi['no_hp'] }}</p>
                    <p><strong>Nama:</strong> {{ $teknisi['nama'] }}</p>
                    <p><strong>Alamat:</strong> {{ $teknisi['alamat'] }}</p>
                    <p><strong>Servis:</strong> {{ $teknisi['servis'] }}</p>
                    <p><strong>Created At:</strong> {{ $teknisi['created_at'] }}</p>
                    <p><strong>Updated At:</strong> {{ $teknisi['updated_at'] }}</p>
                </div>
            
        </div>
    </div>
</x-app-layout>

{{-- $bookings bisa buat tabel seluruh servis --}}
{{-- $garansi bisa buat tabel servis garansi --}}