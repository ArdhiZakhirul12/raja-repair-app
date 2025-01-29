<x-app-layout>
    <div class="m-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard</h1>
        <div class="grid grid-cols-12 gap-4">
            <x-dashboard.dashboard-card-01 title="Servis" total="{{ count($totalServices) }}"/>
            <x-dashboard.dashboard-card-01 title="Pendapatan" total="{{ count($totalCustomers) }}"/>
            <x-dashboard.dashboard-card-01 title="Customer" total="{{ count($totalCustomers) }}"/>
            <x-dashboard.dashboard-card-01 title="Teknisi" total="{{ count($teknisis) }}"/>
            <x-dashboard.dashboard-card-08 title="Pelayanan servis per bulan" total="0" :exMonths="$exMonths" :exSales="$exSales" />
            <x-dashboard.dashboard-card-08 title="Pendapatan per bulan" total="0" :exMonths="$exMonths" :exSales="$exSales" />
            {{-- <x-dashboard.dashboard-card-08 title="Pendapatan per bulan" total="0"/> --}}
            {{-- <x-dashboard.dashboard-card-06 title="Pelayanan per teknisi" :dataName="$phoneBrands" :amountData="$brandPercentages"/>
             --}}

            <x-dashboard.dashboard-card-06 title="10 brand terbanyak" :dataName="$phoneBrands" :amountData="$brandPercentages" />
            <x-dashboard.dashboard-card-06 title="10 servis terbanyak" :dataName="$phoneBrands" :amountData="$brandPercentages" />
            <x-dashboard.dashboard-card-06 title="Repeat Order" :dataName="$phoneBrands" :amountData="$brandPercentages" />
            <x-dashboard.dashboard-card-06-teknisi title="Pelayanan per teknisi" :dataName="$phoneBrands" :amountData="$brandPercentages" />

              {{-- <x-dashboard.dashboard-card-02/>
            <x-dashboard.dashboard-card-03/>
            <x-dashboard.dashboard-card-04/>
            <x-dashboard.dashboard-card-05/> --}}
            {{-- <x-dashboard.dashboard-card-07/>
            <x-dashboard.dashboard-card-08/>
            <x-dashboard.dashboard-card-09/>
            <x-dashboard.dashboard-card-10/>
            <x-dashboard.dashboard-card-11/>
            <x-dashboard.dashboard-card-12/>
            <x-dashboard.dashboard-card-13/> --}}
        </div>
    </div>
</x-app-layout>