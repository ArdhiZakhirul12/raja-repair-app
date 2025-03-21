<x-app-layout>
    <div class="m-6">
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-2 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Dashboard
                </h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end">

                <!-- Filter button -->
                <x-dropdown-filter align="right" />
                <div class="mr-2"></div>
                <!-- Datepicker built with flatpickr -->
                <x-datepicker />
                <div class="mr-2"></div>
                <!-- Add view button -->
                <button
                    class="btn bg-blue-400 text-white hover:bg-gray-800  dark:text-gray-800 dark:hover:bg-white">
                    {{-- <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                  </svg> --}}
                    <span class="max-xs:sr-only">Sesuaikan</span>
                </button>

            </div>

        </div>



        <div class="grid grid-cols-12 gap-4">
           
            {{-- Total data Pendapatan --}}
            <x-dashboard.dashboard-card-06-uang title="Pendapatan Total" total="Rp {{ number_format($total_pendapatan, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Pendapatan Servis" total="Rp {{ number_format($pendapatan_servis, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Pendapatan Sparepart" total="Rp {{ number_format($pendapatan_sparepart, 0, ',', '.') }}" />

            
            <x-dashboard.dashboard-card-08 title="Pendapatan Sparepart per Bulan" total="0" :exMonths="$exMonths"
                :exSales="$sparepartSales" :thisYearTotal="$sparepartThisYear"/>
            <x-dashboard.dashboard-card-08 title="Pelayanan servis per bulan" total="0" :exMonths="$exMonths"
                :exSales="$servisSales" :thisYearTotal="$servisThisYear"/>


            <x-dashboard.dashboard-card-06 title="10 brand terbanyak" :dataName="$phoneBrands" :amountData="$brandPercentages" />
            <x-dashboard.dashboard-card-06 title="10 servis terbanyak" :dataName="$phoneBrands" :amountData="$brandPercentages" />
            <x-dashboard.dashboard-card-06 title="Repeat Order" :dataName="$phoneBrands" :amountData="$brandPercentages" />


            <x-dashboard.dashboard-card-06-data-cabang title="Customer" total="{{ count($totalCustomers) }}" />
            <x-dashboard.dashboard-card-06-data-cabang title="Teknisi" total="{{ count($teknisis) }}" />
            <x-dashboard.dashboard-card-06-data-cabang title="Servis" total="{{ count($totalServices)}}" />

            <x-dashboard.dashboard-card-06-teknisi title="Pelayanan per teknisi" :dataName="$teknisis"
            :amountData="$brandPercentages" />








                {{-- <x-dashboard.dashboard-card-06-rating title="Rating" :data="$rating" :ratingCount="$ratingCounts"
               /> --}}
                {{-- rating --}}
                {{-- <p>total rating : {{$rating}}</p> --}}
            {{-- @foreach ([1, 2, 3, 4, 5] as $rate)
                <p>Rating {{ $rate }}: {{ $ratingCounts[$rate] ?? 0 }}</p>
            @endforeach --}}
              {{-- <x-dashboard.dashboard-card-09/> --}}
            {{-- <x-dashboard.dashboard-card-02/>
            <x-dashboard.dashboard-card-03/>
            <x-dashboard.dashboard-card-04/>
            <x-dashboard.dashboard-card-05/> --}}
            {{-- <x-dashboard.dashboard-card-07/>
            <x-dashboard.dashboard-card-08/>
            <x-dashboard.dashboard-card-09/>
          
            <x-dashboard.dashboard-card-11/>
            <x-dashboard.dashboard-card-12/>
            <x-dashboard.dashboard-card-13/> --}}
        </div>
    </div>
</x-app-layout>
