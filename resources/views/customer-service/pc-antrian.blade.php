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

<body body class="font-sans min-h-screen"
    style="background-image: url('{{ asset('images/bg_login_work.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0" style="background-color: #43230ec8; opacity: 0.8;"></div>
    {{-- <div class=" flex items-start justify-center  ">
        <div class="items-center bg-white p-4 rounded-lg shadow-lg mt-8">

            <div class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30    "
                    height="30    " viewBox="0 0 30    30    " fill="none">
                    <image id="image0_26_78" width="30"
                        xlink:href="data:image/png;base64,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" />

                </svg>
                <h1 class="text-xl font-bold text-center  ml-3" style="color: #302967;">
                    Antrian Ditangani
                </h1>
            </div>
            <hr>
            <div class="flex flex-col items-center mt-4">
                @if ($antrian)
                    <h2 id="current-number" class="text-4xl font-bold" style="color: #3D3480;">
                        {{ $antrian->ditangani }}
                    </h2>
                @else
                    <h2 id="current-number" class="text-4xl font-bold" style="color: #3D3480;">
                        0
                    </h2>
                @endif
            </div>


        </div>

     

    </div> --}}

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


       

        <div class="flex items-stretch max-w-4xl max-h-4xl overflow-hidden rounded-lg relative">
            
            <livewire:rating />

            <div class="flex-grow ml-4">

                <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-md">
                    <h1 class="text-2xl font-bold text-center mb-4 text-orange-600">
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
                            <h2 id="current-number" class="text-4xl font-bold text-orange-600">
                                {{ $antrian?->antrian }}
                            </h2>
                        </div>
                        <div class="flex justify-center mt-4 space-x-4">
                            <button id="next-button" class="bg-orange-600 text-white px-4 py-2 rounded" onclick="next()">
                                Ambil Antrian
                            </button>
                         
                         
                        </div>
                    @endif
                </div>
            </div>
        
        </div>





    </div>






    
    <button onclick="clickMe()">click me</button>
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
    
  
    
        let currentNumber = {{ $antrian->antrian ?? 0 }};
        let id = {{ $antrian->id ?? 0 }};
    
        function next() {
            console.log(currentNumber)
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

   
    
    @stack('modals')

    @livewireScripts

</body>
{{-- <body class="font-sans min-h-screen"
    style="background-image: url('{{ asset('images/raja_repair_bg_login.svg') }}'); background-size: cover; background-position: center;">

   

    <div class="absolute inset-0" style="background-color: #3D3480; opacity: 0.8;"></div>

    <div class="absolute inset-0 flex items-start justify-center z-10 ">
        <div class="items-center bg-white p-4 rounded-lg shadow-lg mt-8">
          
            <div class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="30    " height="30    " viewBox="0 0 30    30    " fill="none">
                <image id="image0_26_78" width="30"
                    xlink:href="data:image/png;base64,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" />
    
            </svg>
                <h1 class="text-xl font-bold text-center  ml-3" style="color: #302967;">
                    Antrian Ditangani
                </h1>
            </div>
                <hr>
                <div class="flex flex-col items-center mt-4">
                    @if ($antrian)
                        <h2 id="current-number" class="text-4xl font-bold" style="color: #3D3480;">
                            {{ $antrian->ditangani }}
                        </h2>
                    @else
                        <h2 id="current-number" class="text-4xl font-bold" style="color: #3D3480;">
                            0
                        </h2>
                    @endif
                </div>
            
          
        </div>
        
    </div>

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


       

        <div class="flex items-stretch max-w-4xl max-h-4xl overflow-hidden rounded-lg relative">
            
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
                            <button id="next-button" class="bg-[#5346AE] text-white px-4 py-2 rounded" onclick="printText()">
                                Ambil Antrian
                            </button>
                            <button id="test-button" class="bg-green-500 text-white px-4 py-2 rounded" onclick="doSomething()">
                                Test Button
                            </button>
                            <script>
                                function doSomething() {
                                    alert("Test button clicked!");
                                }
                            </script>
                        </div>
                    @endif
                </div>
            </div>
        
        </div>





    </div>

    @stack('modals')

    @livewireScripts
</body> --}}



 


</html>
