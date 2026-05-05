@props(['title', 'total', 'exMonths', 'exSales','thisYearTotal'])

@php
    $chartId = Str::slug($title) . '-chart';
@endphp

<div class="flex flex-col col-span-full sm:col-span-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl">
    <header class="px-5 py-4 border-b border-gray-100 dark:border-gray-700/60 flex items-center">
        <div class="flex items-center">

            @if ($title == 'Pelayanan servis per bulan')
                <img src="{{ asset('images/Combo_Chart.svg') }}" alt="logo" class="w-7 mr-3">
            @else
                <img src="{{ asset('images/Analytics.svg') }}" alt="logo" class="w-7 mr-3">
            @endif
            <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $title }}</h2>
        </div>

    </header>
    <div class="px-5 py-3">
        <div class="flex flex-wrap justify-between items-end gap-y-2 gap-x-4">
            <div class="flex items-start justify-end w-full">
            <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">
                @if ($title == 'Pelayanan servis per bulan')
                Rp {{ number_format($thisYearTotal, 0, ',', '.') }}
                @else
                Rp {{ number_format($thisYearTotal, 0, ',', '.') }}
                @endif
            </div>
     
            </div>
        </div>
    </div>
    <canvas id="{{ $chartId }}" class="p-3"></canvas>
  


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
            datasets: [
                {
                label: 'Rp',
                data: sales,
                borderColor: chartType === 'bar' ? 'transparent' : 'blue',
                borderWidth: 2,
                fill: false,
                backgroundColor: chartType === 'bar' ? sales.map((_, i) => `hsl(${i * 30}, 70%, 50%)`) : 'transparent'
            }
        ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
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
                    label: 'Rp',
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
                },
                plugins: {
                    legend: {
                        display: false
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
                    label: 'Bulan ini',
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
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
</script>
