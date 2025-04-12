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
                {{-- <x-dropdown-filter align="right" />
                <div class="mr-2"></div> --}}
                <!-- Datepicker built with flatpickr -->
                <x-datepicker />
                <div class="mr-2"></div>
                <!-- Add view button -->
                <button
                    class="btn bg-blue-400 text-white hover:bg-gray-800  dark:text-gray-800 dark:hover:bg-white">

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


            <x-dashboard.dashboard-card-06 title="10 Model terbanyak" :dataName="$hpModelTotalDataList[0]" :amountData="$hpModelTotalDataList[1]" />
            <x-dashboard.dashboard-card-06 title="10 servis terbanyak" :dataName="$serviceMost10Data2D[0]" :amountData="$serviceMost10Data2D[1]" />
            <x-dashboard.dashboard-card-06 title="Repeat Order" :dataName="$customerTotalDataList2D[0]" :amountData="$customerTotalDataList2D[1]" />


            <x-dashboard.dashboard-card-06-data-cabang title="Customer" total="{{ count($totalCustomers) }}" />
            <x-dashboard.dashboard-card-06-data-cabang title="Teknisi" total="{{ count($teknisis) }}" />
            <x-dashboard.dashboard-card-06-data-cabang title="Servis" total="{{ count($totalServices)}}" />

            <x-dashboard.dashboard-card-06-teknisi title="Pelayanan per teknisi" :dataName="$teknisis"
            :amountData="$customerTotalDataList2D[1]" />


        </div>
    </div>
</x-app-layout>
