

<x-app-layout>

    <div class="sm:flex sm:justify-between sm:items-center ml-8">
        <div class="sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Dashboard Teknisi
            </h1>
        </div>
    </div>
 
    {{-- <p>{{ $teknisi_data }}</p> --}}
    <div class=" mx-6 my-3">
        <div class="grid grid-cols-9 gap-3">

            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service" total="{{$totalBooking}}"/>
            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service Garansi" total="{{$garansi}}"/>

            <x-dashboard.dashboard-card-01-teknisi title="Total Pendapatan" total=" Rp{{number_format($total, 0, ',', '.')}}"/>
            
            <x-dashboard.dashboard-card-08-teknisi title="Pelayanan servis per bulan" total="0" :exMonths=$bulanLabels :exSales=$jumlahServis />
          
                <div class="flex flex-col col-span-full sm:col-span-4 xl:col-span-3 bg-white dark:bg-gray-800 shadow-sm rounded-xl p-4">
                    <h2 class="text-xl font-bold mb-4">Data Teknisi</h2>
                 

                 
                    <p><strong>No HP:</strong></p>
                    <p class="mb-2 ml-3"> {{ $teknisi_data->no_hp }}</p>
                    <p><strong>Nama:</strong></p>
                    <p class="mb-2 ml-3"> {{ $teknisi_data->nama }}</p>
               
                    <p><strong>Servis:</strong></p>
                    <p class="mb-2 ml-3">{{ $teknisi_data->servis }}</p>
                    {{-- <p><strong>Created At:</strong> </p>
                    <p class="mb-2 ml-3">{{ $teknisi_data->created) }}</p> --}}
                    <p><strong>Alamat:</strong></p>
                    <p class=" ml-3">{{ $teknisi_data->alamat }}</p>
                

                </div>
            
        </div>
    </div>

</x-app-layout>