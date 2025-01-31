@props(['title', 'total', 'exMonths', 'exSales'])

@php
    $chartId = Str::slug($title) . '-chart';
@endphp

<div class="flex flex-col col-span-full sm:col-span-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
    <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex items-center">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h2>
    </header>
    <div class="px-5 py-3">
        <div class="flex flex-wrap justify-between items-end gap-y-2 gap-x-4">
            <div class="flex items-start">
                <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">
                    @if ($title == 'Pelayanan servis per bulan')
                        234
                    @else
                        Rp 250.000.000
                    @endif
                </div>
                @if ($title == 'Pelayanan servis per bulan')
                <div class="text-sm font-medium text-green-700 px-1.5 bg-green-500/20 rounded-full">+10%</div>
                @else
                <div class="text-sm font-medium text-red-700 px-1.5 bg-red-500/20 rounded-full">-22%</div>
                @endif
                
            </div>
            {{-- <div id="dashboard-card-08-legend" class="grow mb-1">
                <ul class="flex flex-wrap gap-x-4 sm:justify-end"></ul>
            </div> --}}

        </div>
    </div>
    <canvas id="{{ $chartId }}" class="p-3"></canvas>
    {{-- @if ($title == 'Pelayanan servis per bulan')
        <canvas id="lineChart" class="p-3"></canvas>
    @elseif($title == 'Pendapatan per bulan')
        <canvas id="pendapatanLineChart" class="p-3"></canvas>
    @endif --}}


    {{-- <div class="grow">
        <canvas id="line-chart-dashboard-card-08" width="595" height="248"></canvas>
    </div> --}}


</div>



<script>
    var months = @json($exMonths);
    var sales = @json($exSales);

    var ctx = document.getElementById('{{ $chartId }}').getContext('2d');
    var chartType = '{{ $chartId }}' === 'pelayanan-servis-per-bulan-chart' ? 'line' : 'bar';
    var myChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: months,
            datasets: [{
                label: 'Monthly Sales',
                data: sales,
                borderColor:chartType === 'bar'? 'transparent': 'blue',
                borderWidth: 2,
                fill: false,
                backgroundColor: chartType === 'bar' ? sales.map((_, i) => `hsl(${i * 30}, 70%, 50%)`) : 'transparent'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });




    if (document.getElementById('lineChart')) {
        var ctx = document.getElementById('lineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Monthly Sales',
                    data: sales,
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    if (document.getElementById('pendapatanLineChart')) {
        var ctx = document.getElementById('pendapatanLineChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Monthly Sales',
                    data: sales,
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    // var ctx = document.getElementById('lineChart').getContext('2d');
    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: months,
    //         datasets: [{
    //             label: 'Monthly Sales',
    //             data: sales,
    //             borderColor: 'blue',
    //             borderWidth: 2,
    //             fill: false
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
</script>
