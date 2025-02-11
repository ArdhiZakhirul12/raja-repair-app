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

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gradient-to-br from-[#3D3480] to-[#782059]">



    {{-- 
    <x-banner /> --}}


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


        <div class=" mr-6">

            <div class="bg-white  rounded-lg shadow-xl w-full max-w-md flex flex-col items-center justify-center">
                <div class="flex justify-center bg-white rounded-lg shadow-xl w-full max-w-md relative pt-4">
                    <img src="{{ asset('images/logo_raja.png') }}" alt="logo"
                        class="w-1/5 bg-white p-2 rounded-full \">
                </div>
                <div class="p-6
                        flex flex-col items-center justify-center">
                    <h1 class="text-l text-center mb-4 px-9 text-gray-500 mt-4">Bagaimana penilaian anda terhadap
                        pelayanan kami ?</h1>
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-2 mt-2 rounded">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('cs.rating') }}" method="POST" class="flex flex-col items-center mb-2 mt-4">
                        @csrf
                        <div class="rating flex">
                            <input type="radio" id="star1" name="rating" value="1" onclick="setRating(1)"
                                style="display: none;">
                            <label for="star1" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                                    id="star1-icon"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" onclick="setRating(2)"
                                style="display: none;">
                            <label for="star2" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                                    id="star2-icon"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" onclick="setRating(3)"
                                style="display: none;">
                            <label for="star3" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                                    id="star3-icon"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" onclick="setRating(4)"
                                style="display: none;">
                            <label for="star4" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                                    id="star4-icon"></i></label>
                            <input type="radio" id="star5" name="rating" value="5" onclick="setRating(5)"
                                style="display: none;">
                            <label for="star5" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                                    id="star5-icon"></i></label>
                        </div>

                        {{-- <div class="flex justify-center mt-5">
                        
                            <button type="submit" class="bg-[#5346AE] text-white px-4 py-2 rounded" >Submit</button>
                        </div> --}}
                        <div class="flex justify-center mt-5">

                            <button class="bg-[#5346AE] text-white px-4 py-2 rounded"
                                onclick="showPopup()">Submit</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="mt-4">
                <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-md">
                    @if (!isset($antrian))
                        <button id="next-button" class="bg-blue-500 text-white px-4 py-2 rounded"
                            onclick="mulai()">Mulai
                            Antrian</button>
                    @elseif ($antrian->status == 'tutup')
                        <h1 class="text-2xl font-bold text-center mb-4">Mohon maaf antrian sudah tutup, kembali lagi
                            besok</h1>
                    @else
                        <!-- Logout Form -->
                        <!-- Header -->
                        <h1 class="text-l text-center mb-4 px-6 text-gray-500 mt-4">Klik "Ambil Antrian" untuk
                            mendapatkan antrian
                        </h1>
                        <!-- Display Current Number -->
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                            <h2 id="current-number" class="text-4xl font-bold" style="color: #3D3480;">
                                {{ $antrian?->antrian }}</h2>
                        </div>
                        <!-- Action Buttons -->
                        <div class="flex justify-center mt-4 space-x-4">
                            <button id="next-button" class="bg-[#5346AE] text-white px-4 py-2 rounded"
                                onclick="next()">Ambil
                                Antrian</button>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="w-3/6 ml-6">

            <form method="POST" action="{{ route('logout') }}" x-data class="flex justify-end mt-4">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-full">
                    {{ __('Log Out') }}
                </button>
            </form>
            <img src="{{ asset('images/queue_vector.svg') }}" alt="">
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
