

<x-app-layout>

    <div class="sm:mb-0 flex items-center w-full sm:w-auto justify-between m-6">
        
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Dashboard Teknisi
            </h1>
            <form method="GET" action="{{ route('teknisi.dashboard')}}">

                <!-- Right: Actions -->
                {{-- <input type="hidden" name="id" value={{ request('id') }}> --}}
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end">
                    <input type="text" name="date_range" class="rounded-lg"  value="{{ request('date_range') }}"/>
      
                    <button type="submit"
                        class="btn ml-2 bg-blue-400 text-white hover:bg-gray-800  dark:text-gray-800 dark:hover:bg-white">
    
                        <span class="max-xs:sr-only">Sesuaikan</span>
                    </button> 
    
                </div>
            </form>
    </div>
 
    {{-- <p>{{ $teknisi_data }}</p> --}}
    <div class=" mx-6 my-3">
        <div class="grid grid-cols-9 gap-3">

            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service" total="{{$bookings->count()}}" detail=""/>
            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service Garansi" total="{{$garansi->count()}}" detail=""/>

            <x-dashboard.dashboard-card-01-teknisi title="Total Pendapatan" total=" Rp{{number_format($total, 0, ',', '.')}}" detail=""/>
            
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

    <script>
        $(function() {
          $('input[name="date_range"]').daterangepicker({
            opens: 'left',
            locale: {
            applyLabel: 'Pilih',        // Ganti label Apply jadi "Pilih"
            cancelLabel: 'Batal',       // (Opsional) Ganti Cancel jadi "Batal"
            format: 'YYYY-MM-DD'        // (Opsional) Format tanggal
        }
            
          }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          });

          // Add clear button functionality
          const clearButton = $('<button>')
            .text('Clear')
            .addClass('btn ml-2 bg-red-400 text-white hover:bg-red-600')
            .on('click', function() {
              $('input[name="date_range"]').val('');
            });

          $('input[name="date_range"]').after(clearButton);
        });
        </script>

</x-app-layout>