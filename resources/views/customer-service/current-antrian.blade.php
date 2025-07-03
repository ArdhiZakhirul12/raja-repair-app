<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
</head>
    <div class="absolute inset-0" style="background-color: #43230ec8; opacity: 0.8;"></div>
<body class="font-sans antialiased min-h-screen relative"
style="background-image: url('{{ asset('images/bg_login_work.jpg') }}'); background-size: cover; background-position: center;">
<div class="absolute inset-0" style="background-color: #43230ec8; opacity: 0.8;"></div>
    <div class="flex items-center justify-center min-h-screen absolute inset-0 z-10">
        {{-- <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h1 class="text-xl font-bold text-center mb-4" style="color: #302967;">
                Total Antrian
            </h1>
            <div id="current-antrian" class="text-center">
                <!-- Current Antrian will be displayed here -->
                <hr>
                
                <div class="flex flex-col items-center mt-4">
                    @if ($antrian)
                        <h2 id="current-number" class="text-8xl font-bold" style="color: #3D3480;">
                            {{ $antrian->antrian }}
                        </h2>
                    @else
                        <h2 id="current-number" class="text-4xl font-bold" style="color: #3D3480;">
                            0
                        </h2>
                    @endif
                </div>
                <hr>
                <h1 class="mt-4">PENGANTRE</h1>
            </div>
        </div> --}}
        {{-- <div class="mr-4">

        </div> --}}
        <div class="bg-white rounded-lg shadow-lg p-10 w-96">
            <h1 class="text-3xl font-bold text-center mb-4 text-orange-600">
                Antrian Ditangani
            </h1>
            <div id="current-antrian" class="text-center">
                <!-- Current Antrian will be displayed here -->
                <hr>
                <h1 class="mt-4">NOMOR</h1>
                <div class="flex flex-col items-center mt-4">
                    @if ($antrian)
                        <h2 id="current-number" class="text-9xl font-bold text-orange-600" >
                            {{ $antrian->ditangani }}
                        </h2>
                    @else
                        <h2 id="current-number" class="text-4xl font-bold text-orange-600" >
                            0
                        </h2>
                    @endif
                </div>
            </div>
        </div>
    

    </div>
    
</body>
