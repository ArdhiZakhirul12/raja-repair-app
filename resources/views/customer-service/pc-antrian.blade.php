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

<body class="font-sans antialiased min-h-screen relative" style="background-image: url('{{ asset('images/raja_repair_bg_login.svg') }}'); background-size: cover; background-position: center;">



    <div class="absolute inset-0" style="background-color: #3D3480; opacity: 0.8;"></div>


    <div class="flex h-screen items-center justify-center">
        <div id="floating-card"
            style="display: none; width: auto; width: 20%; right: 0; top: 15%; transform: translateY(-50%);"
            class="floating-card m-6 fixed flex items-center justify-center z-50">
            @if (session('success'))
                <div class="card bg-white p-6 rounded-lg shadow-xl">
                    <div class="card-body text-center">
                        <i class="fas fa-star fa-3x mb-4" style="color: #FFD43B;"></i>
                        <h5 class="card-title text-2xl font-bold mb-4" style="color: #3D3480;">Terimakasih!</h5>
                        <p class="card-text text-gray-600">Penilaian anda telah kami terima.</p>
                    </div>
                </div>
            @endif

        </div>
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

        <div class="flex items-stretch max-w-4xl max-h-4xl overflow-hidden rounded-lg relative">
            <!-- Bagian Kiri -->
            {{-- <div class="w-3/6 h-full flex flex-col"> --}}
                <livewire:rating />
        
                <div class="flex-grow ml-4">
                  
                    <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-md">
                        <h1 class="text-2xl font-bold text-center mb-4" style="color: #302967;">
                            Antrian Service
                        </h1>
                        @if (!isset($antrian))
                            <button id="next-button" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="mulai()">
                                Mulai Antrian
                            </button>
                        @elseif ($antrian->status == 'tutup')
                            <h1 class="text-2xl font-bold text-center mb-4">
                                Mohon maaf antrian sudah tutup, kembali lagi besok
                            </h1>
                        @else
                            <h1 class="text-l text-center mb-4 px-6 text-gray-500 mt-4">
                                Klik "Ambil Antrian" untuk mendapatkan antrian
                            </h1>
                            <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                                <h2 id="current-number" class="text-4xl font-bold" style="color: #3D3480;">
                                    {{ $antrian?->antrian }}
                                </h2>
                            </div>
                            <div class="flex justify-center mt-4 space-x-4">
                                <button id="next-button" class="bg-[#5346AE] text-white px-4 py-2 rounded" onclick="next()">
                                    Ambil Antrian
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            {{-- </div> --}}
        
            <!-- Bagian Kanan -->
            {{-- <div class="w-3/6 h-full rounded-lg overflow-hidden">
                <img src="{{ asset('images/side_rating_bg.jpg') }}" class="w-full h-full object-cover" alt="antrian image">
            </div> --}}
        </div>
        


        

    </div>

    @stack('modals')

    @livewireScripts
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            const floatingCard = document.getElementById('floating-card');
            floatingCard.style.display = 'block'; // Show the floating card
        });
        const floatingCard = document.getElementById('floating-card');
        floatingCard.style.display = 'block'; // Show the floating card
        floatingCard.style.opacity = 1; // Ensure opacity is set to 1

        setTimeout(() => {
            floatingCard.style.transition = 'opacity 1s'; // Set transition for opacity
            floatingCard.style.opacity = 0; // Fade out the floating card
        }, 2000);

        setTimeout(() => {
            floatingCard.style.display = 'none'; // Hide the floating card after fade out
        }, 3000);
    });

    function showPopup() {
        let inputValue = document.getElementByName("rating").value;
        console.log(inputValue)
        if (!inputValue) {
            alert("Input tidak boleh kosong!");
            return;
        }
        // fetch('{{ route('cs.rating') }}', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF Token
        //     },
        //     body: JSON.stringify({ rating: inputValue })
        // })
        // .then(response => response.json())
        // .then(data => {
        //     alert("Response dari server: " + data.message);
        //     window.location.href = `/target-route-response`; // Redirect jika perlu
        // })
        // .catch(error => console.error('Error:', error));


        resetRating();
         // Ensure this timeout is longer than the fade out duration
    }

    function resetRating() {
        for (let i = 1; i <= 5; i++) {
            const starIcon = document.getElementById(`star${i}-icon`);
            starIcon.classList.add('far');
            starIcon.classList.remove('fas');
        }
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        ratingInputs.forEach(input => input.checked = false);
    }



    function setRating(rating) {
        for (let i = 1; i <= 5; i++) {
            const starIcon = document.getElementById(`star${i}-icon`);
            if (i <= rating) {
                starIcon.classList.add('fas');
                starIcon.classList.remove('far');
            } else {
                starIcon.classList.add('far');
                starIcon.classList.remove('fas');
            }
        }
    }
</script>

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
