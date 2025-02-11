@props(['title', 'data', 'ratingCount'])

@php
    $chartId = Str::slug($title) . '-chart';
@endphp


<div class="flex  flex-col col-span-full sm:col-span-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
    <header class="flex items-center px-3 py-4 border-b border-gray-100 dark:border-gray-700/60">
        <img src="{{ asset('images/Rating.svg') }}" class="w-7 h-7 mr-2">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h2>
    </header>

    @php
    $maxAmount = collect($ratingCount)->max('total');
    $responsAmount = collect($ratingCount)->sum('total');
    // print_r($maxAmount);
    $progress = $maxAmount > 0 ? ($ratingCounts->total / $maxAmount) * 100 : 0;

@endphp

    <div class="flex item-center justify-center p-4">

    <div class="w-1/4 p-2 flex flex-col items-center">
        <h1 class="text-4xl">{{ $data }}</h1>
        <div class="flex items-center my-2">
            @for ($i = 1; $i <= floor($data); $i++)
                <img src="{{ asset('images/star_filled.svg') }}" class="w-4 h-4">
            @endfor
            @if ($data - floor($data) >= 0.5)
                <img src="{{ asset('images/Star_Filled_half.svg') }}" class="w-4 h-4">
            @endif
        </div>
        <p>({{ $responsAmount }})</p>
    </div>

        <div class="w-3/4">
 
            @foreach ([1, 2, 3, 4, 5] as $rate)
                <div class="flex items-center mb-2">
                    

              

                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mr-2">
                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                    </div>

                    <div class="flex">
                        <img src="{{ asset('images/star_filled.svg') }}" class="w-5 h-5 ">
                        {{ $rate }}
                    </div>
                    
                    {{-- {{ $ratingCounts[$rate] ?? 0 }} --}}
                </div>
            @endforeach
        </div>

        {{-- <p>{{ $ratingCount }}</p> --}}


    </div>




    {{-- @foreach ($sortedData as $key => $item)
        @php
            $colorClass = '';
            $card = 'rounded bg-white shadow';
            if ($key == 0) {
                $colorClass = 'text-yellow-500';
                $barColor = 'bg-yellow-500';
            } elseif ($key == 1) {
                $colorClass = 'text-green-500';
                $barColor = 'bg-green-500';
            } elseif ($key == 2) {
                $colorClass = 'text-blue-500';
                $barColor = 'bg-blue-500';
            } elseif ($key == 3) {
                $colorClass = 'text-red-400';
                $barColor = 'bg-red-400';
            } elseif ($key == 4) {
                $colorClass = 'text-sky-500';
                $barColor = 'bg-sky-500';
            }
            else {
                $card = 'bg-white';
                $barColor = 'bg-gray-500';
            }
        @endphp
        <div class="items-center justify-between px-2 py-2 {{ $card }} mx-3 my-2">
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
    @endforeach --}}
    <div>

    </div>

</div>
