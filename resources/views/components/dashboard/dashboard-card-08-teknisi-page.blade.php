@props(['title'])

@php
    $chartId = Str::slug($title) . '-chart';
@endphp

<div class="flex flex-col col-span-full sm:col-span-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
    <header class="px-4 py-4 border-b border-gray-100 dark:border-gray-700/60 flex items-center">
        <div class="flex items-center">

            {{-- @if ($title == 'Pelayanan servis per bulan')
                <img src="{{ asset('images/Combo_Chart.svg') }}" alt="logo" class="w-7 mr-3">
            @else
                <img src="{{ asset('images/Analytics.svg') }}" alt="logo" class="w-7 mr-3">
            @endif --}}
            <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h1>
        </div>

    </header>

    <div class="flex flex-wrap gap-y-2 gap-x-4 px-3 py-2 bg-gray-100 dark:bg-gray-700/60 w-auto m-2">
        <div class="p-2 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <h1>Dikerjakan</h1>
        </div>
        <div class="p-2  shadow-sm rounded-lg">
            <h1>Selesai</h1>
        </div>
    </div>


</div>


