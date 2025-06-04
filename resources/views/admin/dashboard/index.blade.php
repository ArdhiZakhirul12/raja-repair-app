<x-app-layout>
    <div class="m-6">
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-2 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                    Dashboard Admin
                </h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end">

                <div class="relative inline-block text-left">
                    <div class="flex items-center space-x-4">
                        <input type="text" id="selected-cabang"
                            class="border border-gray-300 rounded-md px-4 py-2 text-sm" placeholder="Selected Cabang" 
                            value="{{ $cabangNama ? 'Cabang ' . ($cabangNama ?? 'Tidak Diketahui') : 'Semua Cabang' }}" readonly>
                        <button type="button" id="menu-button-cabang"
                            class="bg-primary inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 text-sm font-medium text-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            aria-expanded="true" aria-haspopup="true">
                            Pilih Cabang
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div id="list-dropdown-cabang"
                        class="dropdown-cabang origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg hidden"
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <a 
                            @click="window.location.href='{{ route('admin.dashboard')}}'"
                
                            class="text-gray-700 block px-4 py-2 text-sm cursor-pointer dark:hover:text-white" 
                            role="menuitem" tabindex="-1">
                                Seluruh Cabang
                            </a>
                           
                            @foreach ($cabangs as $cabang)
                            
                                <a 
                                @click="window.location.href='{{ route('admin.dashboard', ['cabang' => $cabang->nama]) }}'"
                           
                                class="text-gray-700 block px-4 py-2 text-sm cursor-pointer dark:hover:text-white" 
                                role="menuitem" tabindex="-1">
                                    Cabang {{ $cabang->nama }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                </div>

            </div>

        </div>



        <div class="grid grid-cols-12 gap-4">

            {{-- Total data Pendapatan --}}
            <x-dashboard.dashboard-card-06-uang title="Pendapatan Total"
                total="Rp {{ number_format($total_pendapatan, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Pendapatan Servis"
                total="Rp {{ number_format($pendapatan_servis, 0, ',', '.') }}" />
            <x-dashboard.dashboard-card-06-uang title="Pendapatan Sparepart"
                total="Rp {{ number_format($pendapatan_sparepart, 0, ',', '.') }}" />


            <x-dashboard.dashboard-card-08 title="Pendapatan Sparepart per Bulan" total="0" :exMonths="$exMonths"
                :exSales="$sparepartSales" :thisYearTotal="$sparepartThisYear" />
            <x-dashboard.dashboard-card-08 title="Pelayanan servis per bulan" total="0" :exMonths="$exMonths"
                :exSales="$servisSales" :thisYearTotal="$servisThisYear" />


            <x-dashboard.dashboard-card-06 title="10 Model terbanyak" :dataName="$hpModelTotalDataList[0]" :amountData="$hpModelTotalDataList[1]" />
            <x-dashboard.dashboard-card-06 title="10 servis terbanyak" :dataName="$serviceMost10Data2D[0]" :amountData="$serviceMost10Data2D[1]" />
            <x-dashboard.dashboard-card-06 title="Repeat Order" :dataName="$customerTotalDataList2D[0]" :amountData="$customerTotalDataList2D[1]" />


            <x-dashboard.dashboard-card-06-data-cabang title="Customer" total="{{ count($totalCustomers) }}" />
            <x-dashboard.dashboard-card-06-data-cabang title="Teknisi" total="{{ count($teknisis) }}" />
            <x-dashboard.dashboard-card-06-data-cabang title="Servis" total="{{ count($totalServices) }}" />

            <x-dashboard.dashboard-card-06-teknisi title="Pelayanan per teknisi" :dataName="$teknisis"
                amountData="serviceMost10Data2D[1]" />
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var menuItems = document.querySelectorAll('#list-dropdown-cabang a');
            var selectedCabangInput = document.getElementById('selected-cabang');

            menuItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    selectedCabangInput.value = this.textContent.trim();
                    document.getElementById('list-dropdown-cabang').classList.add('hidden');
                });
            });

            var button = document.getElementById('menu-button-cabang')
            var menu = document.getElementById('list-dropdown-cabang')
            button.addEventListener('click', function() {
                menu.classList.toggle('hidden')

            })
        });
    </script>
</x-app-layout>
