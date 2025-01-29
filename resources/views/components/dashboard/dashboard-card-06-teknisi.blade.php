@props(['title', 'dataName', 'amountData'])

@php
    $chartId = Str::slug($title) . '-chart';
@endphp


<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
    <header class="flex items-center px-3 py-4 border-b border-gray-100 dark:border-gray-700/60">
        <img src="{{ asset('images/Order_completed.svg') }}"  class="w-8 h-8 mr-2">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h2>
    </header>
    @php
        $sortedData = collect($dataName)
            ->map(function ($item, $key) use ($amountData) {
                return ['name' => $item, 'amount' => $amountData[$key]];
            })
            ->sortByDesc('amount')
            ->values()
            ->all();
    @endphp

    @foreach ($sortedData as $key => $item)
        @php
            $colorClass = '';
            if ($key == 0) {
                $colorClass = 'text-yellow-500';
                $barColor = 'bg-yellow-500';
            } elseif ($key == 1) {
                $colorClass = 'text-green-500';
                $barColor = 'bg-green-500';
            } elseif ($key == 2) {
                $colorClass = 'text-blue-500';
                $barColor = 'bg-blue-500';
            } else {
                $barColor = 'bg-gray-500';
            }
        @endphp
        <div class="items-center justify-between px-2 py-2 rounded bg-white shadow mx-3 my-2">
            <div class="flex items-center">
               
                <img src="{{ asset('images/logo_raja.png') }}" alt="{{ $item['name'] }}" class="w-8 h-8 rounded-full mr-2">
                <div>
                    <div class="text-sm font-semibold text-gray-500 dark:text-gray-500">{{ $item['name'] }}</div>
                    <span class="text-xs text-gray-400">Jumlah</span>
                </div>
            </div>

            <div class="flex items-center justify-between">
                @php
                    $maxAmount = max($amountData);
                    $progress = ($item['amount'] / $maxAmount) * 100;
                @endphp
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mr-2">
                    <div class="{{ $barColor }} h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                </div>
                <div class="text-lg font-bold {{ $colorClass }} dark:text-gray-100">{{ $item['amount'] }}</div>

            </div>
        </div>
    @endforeach
    <div>

    </div>

</div>
