<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Total Antrian') }} {{$antrian?->antrian}}
        </h2>
    </x-slot>
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="mb-4 sm:mb-5 ">
        <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
            Halaman Customer Service
        </h1>
    </div>

    @if ($antrian == null)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <button id="next-button" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="mulai()">Mulai
                Antrian</button>
        </div>
    @else
        <div class="flex">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 divide-y divide-dashed flex-grow">
            <h1 class="text-2xl  text-center mb-4">Antrian yang Sedang Ditangani</h1>
        
            <div class="text-center">
                <h2 id="current-number" class="text-4xl font-bold">{{ $antrian->ditangani }}</h2>
            </div>

            <div class="flex justify-center mt-4 p-4 space-x-4 ">
                <button id="prev-button" class="bg-gray-500 text-white px-4 py-2 rounded"
                onclick="previous()">Sebelumnya</button>
                <button id="next-button" class="bg-blue-500 text-white px-4 py-2 rounded"
                onclick="next()">Selanjutnya</button>               
            </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 m-10 w-1/4 divide-y divide-dashed">
                <h3>Pengaturan Antrian</h3>
            <div class="flex justify-center mt-4 space-x-4 py-3">
                <button id="reset-button" class="bg-red-500 text-white px-4 py-2 rounded"
                onclick="reset()">Reset</button>
                <form action="{{ route('cs.antrianStatus.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$antrian->id}}">
                @if ($antrian->status == 'buka')
                    <input type="hidden" name="status" value="tutup">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                    Tutup Request Antrian
                    </button>
                @else
                    <input type="hidden" name="status" value="buka">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                    Buka Request Antrian
                    </button>
                @endif
                </form>
            </div>
            </div>
        </div>
       
    @endif
    
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
        let currentNumber = {{ $antrian->ditangani ?? 0 }};
        let antrian = {{ $antrian->antrian ?? 0 }};
        let id = {{ $antrian->id ?? 0 }};


        // Fungsi untuk memutar suara

        function playAudio(number) {
            const message = new SpeechSynthesisUtterance(`Nomor antrian ${number}, silakan ke customer service`);
            message.lang = 'id-ID'; // Bahasa Indonesia
            speechSynthesis.speak(message);
        }

        // Fungsi untuk tombol Next
        function next() {
            if (currentNumber < antrian) {
            currentNumber++;

            fetch("{{ route('cs.antrian.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: id,
                        ditangani: currentNumber // Update nilai 'ditangani' dengan nomor antrian yang baru
                    })
                })
                .then(response => response.json()) // Menangani respons dari server
                .then(data => {
                    if (data.success) {
                        document.getElementById('current-number').innerText = currentNumber;
                        playAudio(currentNumber); // Mainkan audio jika berhasil
                    } else {
                        alert('Gagal memperbarui data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }else{
                alert("Nomor antrian sudah habis");
            }
        }

        // Fungsi untuk tombol Previous
        function previous() {
            if (currentNumber > 0) {
                currentNumber--;
                fetch("{{ route('cs.antrian.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: id,
                        ditangani: currentNumber // Update nilai 'ditangani' dengan nomor antrian yang baru
                    })
                })
                .then(response => response.json()) // Menangani respons dari server
                .then(data => {
                    if (data.success) {
                        document.getElementById('current-number').innerText = currentNumber;
                        playAudio(currentNumber); // Mainkan audio jika berhasil
                    } else {
                        alert('Gagal memperbarui data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                alert("Nomor antrian sudah di angka 0.");
            }
        }
        

        // Fungsi untuk tombol Reset
        function reset() {
            currentNumber = 0;
            fetch("{{ route('cs.antrian.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: id,
                        ditangani: currentNumber, // Update nilai 'ditangani' dengan nomor antrian yang baru
                        antrian: currentNumber // Update nilai 'ditangani' dengan nomor antrian yang baru
                    })
                })
                .then(response => response.json()) // Menangani respons dari server
                .then(data => {
                    if (data.success) {
                        document.getElementById('current-number').innerText = currentNumber;
                        playAudio(currentNumber); // Mainkan audio jika berhasil
                    } else {
                        alert('Gagal memperbarui data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });            
            // playAudio(currentNumber);
        }
    </script>
</x-app-layout>
