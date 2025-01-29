@props(['title', 'dataName', 'amountData'])

@php
    $chartId = Str::slug($title) . '-chart';
@endphp


<div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
    <header class="flex items-center px-3 py-4 border-b border-gray-100 dark:border-gray-700/60">
        
        @if($title == '10 brand terbanyak')
            <img src="{{ asset('images/Multiple_Devices.svg') }}"  class="w-8 h-8 mr-2">
        @elseif($title == '10 servis terbanyak')
            <img src="{{ asset('images/Request_service.svg') }}"  class="w-8 h-8 mr-2">
        @elseif($title == 'Repeat Order')
            <img src="{{ asset('images/Consumable.svg') }}"  class="w-8 h-8 mr-2">
        @endif
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h2>
    </header>
    {{-- <div class="grow flex flex-col justify-center">
        <div>
            <canvas id="dashboard-card-06" width="389" height="260"></canvas>
        </div>
        <div id="dashboard-card-06-legend" class="px-5 pt-2 pb-6">
            <ul class="flex flex-wrap justify-center -m-1"></ul>
        </div>
    </div> --}}
    <canvas id="{{ $chartId }}" class="p-3"></canvas>
</div>



<script>
    var months = @json($dataName);
    var sales = @json($amountData);

    var ctx = document.getElementById('{{ $chartId }}').getContext('2d');
    var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: months,
            datasets: [{
                label: 'Monthly Sales',
                data: sales,
                borderWidth: 2,
                backgroundColor: months.map((_, index) =>
                    `hsl(${index * 360 / months.length}, 100%, 75%)`),
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                            let value = tooltipItem.raw;
                            let percentage = ((value / total) * 100).toFixed(2);
                            return `${tooltipItem.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
