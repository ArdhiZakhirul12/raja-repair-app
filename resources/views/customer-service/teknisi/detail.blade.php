<x-app-layout>
    {{-- <p>jumlah service : {{$bookings->count()}}</p>
    <p>jumlah service garansi : {{$garansi->count()}}</p>
    <p>Total pendapatan : Rp{{number_format($total, 0, ',', '.')}}</p> --}}
    
        <div class="sm:mb-0 flex items-center w-full sm:w-auto justify-between m-6">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Detail Teknisi
            </h1>
            <form method="GET" action="{{ route('cs.teknisi.show', ['id' => request('id')]) }}">

                <!-- Right: Actions -->
                <input type="hidden" name="id" value={{ request('id') }}>
                <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end">
                    <input type="text" name="date_range" class="rounded-lg"  value="{{ request('date_range') }}"/>
      
                    <button type="submit"
                        class="btn ml-2 bg-blue-400 text-white hover:bg-gray-800  dark:text-gray-800 dark:hover:bg-white">
    
                        <span class="max-xs:sr-only">Sesuaikan</span>
                    </button> 
    
                </div>
            </form>
            {{-- <div>
                <input type="text" name="date_range" class="rounded-lg form-control cursor-pointer"
           placeholder="Pilih Range Tanggal" readonly />
            </div> --}}
        </div>
 
    {{-- <p>{{ $bookings }}</p> --}}

    <div class=" mx-6 my-3">
        <div class="grid grid-cols-9 gap-3">
            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service" total="{{$bookings->count()}}" detail="/cs/teknisi/booking/{{$teknisi['id']}}"/>
            <x-dashboard.dashboard-card-01-teknisi title="Jumlah Service Garansi" total="{{$garansi->count()}}" detail="/cs/teknisi/claim/{{$teknisi['id']}}"/>
            <x-dashboard.dashboard-card-01-teknisi title="Total Pendapatan" total=" Rp{{number_format($total, 0, ',', '.')}}" detail="tes"/>
            
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
                                    if($ratings_per_id == null){
                                        echo 'Belum ada rating';
                                    } else {
                                        $rating = number_format($ratings_per_id["average_rating"], 1);
                                        if ($rating >= 1 && $rating <= 2) {
                                            echo '😞 Tidak Puas';
                                        } elseif ($rating > 2 && $rating < 3) {
                                            echo '😐 Puas';
                                        } elseif ($rating == 3) {
                                            echo '😊 Sangat Puas';
                                        }
                                    }
                                 
                                @endphp
                            </span>
                            @php
                                if($ratings_per_id == null){
                                    echo '<span class="text-xs text-gray-400 pl-3">(0)</span>';
                                } else {
                                    echo '<span class="text-xs text-gray-400 pl-3">(' . 
                                    number_format($ratings_per_id["average_rating"], 1) . ')</span>';
                                }
                            @endphp
                        </div>
                    </div>
                    {{-- <div>
                        @php
                        $rating = number_format($ratings_per_id["average_rating"], 1);
                        if ($rating >= 1 && $rating <= 2) {
                            echo '<span style="font-size: 2rem;">😞</span>';
                        } elseif ($rating > 2 && $rating < 3) {
                            echo '<span style="font-size: 2rem;">😐</span>';
                        } elseif ($rating == 3) {
                            echo '<span style="font-size: 2rem;">😊</span>';
                        }
                        @endphp
                        <span class="text-xs text-gray-400 pl-3">({{ number_format($ratings_per_id["average_rating"], 1) }})</span>
                    </div> --}}
              
                       
                        <div class="flex ">
                            @php
                                $maxAmount = max($ratingCounts->toArray());
                                // print_r($maxAmount);
                                $progress_03 = $maxAmount > 0 ? ( $ratingCounts[3] / $maxAmount) * 100 : 0;
                                $progress_02 = $maxAmount > 0 ? ( $ratingCounts[2] / $maxAmount) * 100 : 0;
                                $progress_01 = $maxAmount > 0 ? ( $ratingCounts[1] / $maxAmount) * 100 : 0;
                     
                            @endphp
                    
                            
                            
                        </div> 

                        <div class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500 dark:text-gray-100 w-24">Sangat Puas</div>
                                <div class="w-full ml-2 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mr-2">
                                    <div class="h-2.5 rounded-full" style="width: {{ $progress_03 }}%; background-color: yellow;"></div>
                                </div>
                                <div class="text-l  text-black dark:text-gray-100">{{ $ratingCounts[3] }}</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500 dark:text-gray-100 w-24">Puas</div>
                                <div class="w-full ml-2 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mr-2">
                                    <div class="h-2.5 rounded-full" style="width: {{ $progress_02 }}%; background-color: yellow;"></div>
                                </div>
                                <div class="text-l  text-black dark:text-gray-100">{{ $ratingCounts[2] }}</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500 dark:text-gray-100 w-24">Tidak Puas</div>
                                <div class="w-full ml-2 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mr-2">
                                    <div class="h-2.5 rounded-full" style="width: {{ $progress_01 }}%; background-color: yellow;"></div>
                                </div>
                                <div class="text-l  text-black dark:text-gray-100">{{ $ratingCounts[1] }}</div>
                            </div>
                        </div>
                     

                 
                    
                   
                    {{-- <p><strong>Updated At:</strong> {{ $teknisi['updated_at'] }}</p> --}}
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

{{-- $bookings bisa buat tabel seluruh servis --}}
{{-- $garansi bisa buat tabel servis garansi --}}