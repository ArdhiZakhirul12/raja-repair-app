@props(['title', 'total'])

@php
    $chartId = Str::slug($title) . '-chart';
@endphp


<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-gray-800  shadow-sm rounded-xl">
    <header class="flex items-center px-3 py-4 border-b border-gray-100 dark:border-gray-700/60">

        @if ($title == 'Pendapatan Total' || $title == 'Pendapatan Bersih')
            <img src="{{ asset('images/Profit.svg') }}" alt="" class="w-7 h-7 mr-2">
        @elseif($title == 'Pendapatan Servis' || $title == 'Total Pendapatan')
            <img src="{{ asset('images/Request_service.svg') }}" class="w-7 h-7 mr-2">
        @elseif($title == 'Pendapatan Sparepart' || $title == 'Total Pengeluaran')
            <img src="{{ asset('images/Consumable.svg') }}" class="w-7 h-7 mr-2">
        @endif
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h2>
    </header>

    @if ($title == 'Total Pendapatan' || $title == 'Pendapatan Bersih' || $title == 'Total Pengeluaran')
        @php
            $textColor = match ($title) {
                'Total Pendapatan' => 'text-yellow-500',
                'Pendapatan Bersih' => 'text-green-500',
                'Total Pengeluaran' => 'text-red-500',
                default => 'text-gray-400',
            };
        @endphp
        <div class="text-3xl font-bold  {{ $textColor }} dark:text-gray-100 mr-2 pl-4">

            {{ $total }}


        </div>
    @else
        <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2 pl-4">

            {{ $total }}


        </div>
    @endif
    {{-- <div class="grow flex flex-col justify-center">
        <div>
            <canvas id="dashboard-card-06" width="389" height="260"></canvas>
        </div>
        <div id="dashboard-card-06-legend" class="px-5 pt-2 pb-6">
            <ul class="flex flex-wrap justify-center -m-1"></ul>
        </div>
    </div> --}}

    <p class="text-sm text-gray-400 pl-4 pb-3">Total keseluruhan {{ $title }}</p>

</div>
