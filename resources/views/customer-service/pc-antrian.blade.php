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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen">
        {{-- @livewire('navigation-menu') --}}

        <!-- Page Heading -->
        {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

        <!-- Page Content -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 h-screen ">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
            <div class="flex items-center justify-center h-screen">
                <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-md">
                    @if (!isset($antrian))                        
                    
                        <button id="next-button" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="mulai()">Mulai
                            Antrian</button>
                    
                    @elseif ($antrian->status == 'tutup')
                    <h1 class="text-2xl font-bold text-center mb-4">Mohon maaf antrian sudah tutup, kembali lagi besok</h1>
                    @else                                        
                    <!-- Logout Form -->
                    <!-- Header -->
                    <h1 class="text-2xl font-bold text-center mb-4">Klik "Ambil Antrian" untuk mendapatkan antrian</h1>
                    <!-- Display Current Number -->
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                        <h2 id="current-number" class="text-4xl font-bold">{{ $antrian?->antrian }}</h2>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex justify-center mt-4 space-x-4">
                        <button id="next-button" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="next()">Ambil
                            Antrian</button>
                    </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

<script>
    function mulai() {
            // Membuat form dinamis untuk POST
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('cs.antrian.store') }}";

            // Menambahkan token CSRF
            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Menambahkan elemen lainnya jika perlu
            // var input = document.createElement('input');
            // input.type = 'hidden';
            // input.name = 'key';
            // input.value = 'value';
            // form.appendChild(input);

            // Menambahkan form ke body dan mengirimnya
            document.body.appendChild(form);
            form.submit();
        }
</script>
<script>
    let currentNumber = {{ $antrian->antrian ?? 0 }};
    let id = {{ $antrian->id ?? 0 }};

    function next() {
        currentNumber++;
        

        fetch("{{ route('cs.pcAntrian.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: id,
                    antrian: currentNumber // Update nilai 'ditangani' dengan nomor antrian yang baru
                })
            })
            .then(response => response.json()) // Menangani respons dari server
            .then(data => {
                if (data.success) {
                    printNumber(currentNumber);
                    document.getElementById('current-number').innerText = currentNumber;
                } else {
                    alert('Gagal memperbarui data');
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

    }

    function printNumber(number) {
        const printWindow = window.open('', '', 'width=400,height=400');
        printWindow.document.write(`
           <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Antrian</title>
    <style>
        /* Atur gaya untuk tampilan cetak */
        @media print {
            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100mm; /* Lebar kertas 10 cm */
                height: 100mm; /* Tinggi kertas 10 cm */
                font-family: Arial, sans-serif;
                text-align: center;
            }
            .container {
                width: 90%; /* Mengurangi sedikit margin */
                height: 90%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            h2 {
                font-size: 24px;
                margin: 0;
            }
            h1 {
                font-size: 50px;
                font-weight: bold;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>ANTRIAN NOMOR</h2>
        <h1>${number}</h1>
    </div>
</body>
</html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>

</html>
