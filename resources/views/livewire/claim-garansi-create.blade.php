<div>
    <div class="inset-0 z-50 flex items-center justify-center bg-opacity-50 m-6">
        <div class="bg-white p-10 rounded-lg shadow-lg w-200 flex">

            <div class="w-1/3">
                <div class="flex justify-center">
                    <img src="{{ asset('images/garansi.png') }}" alt="Edit Teknisi" class="w-35 object-cover rounded-l-lg">
                </div>

            </div>
            <div class="w-2/3 p-6 mx-6">
                @if (isset($feedbackMessage))
                    <div class="p-4 mb-4 text-blue-700 bg-blue-100 rounded">
                        {{ $feedbackMessage }}
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                        {{ session('message') }}
                        {{-- {{ session('inputData')[''] }} --}}

                    </div>
                @endif
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/Reset.svg') }}" alt="garansi"
                        class="w-8 h-8 object-cover rounded-l-lg mr-2">
                    <h2 class="text-xl font-semibold">Claim Garansi</h2>
                </div>

                <form wire:submit.prevent="submit">
                    @csrf
                    <div class="">
                        <label for="nota" class="block text-sm font-medium text-gray-400">Nota</label>
                        <input type="text" id="nota" wire:model="nota"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if ($errors->has('nota'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('nota')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="mt-4">
                        <label for="noHp" class="block text-sm font-medium text-gray-400">No Hp</label>
                        <input type="text" id="noHp" wire:model="noHp"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if ($errors->has('noHp'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('noHp')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-end mr-4 mt-4">
                        <button {{-- onclick="if (document.getElementById('nohp').value && document.getElementById('nama').value && document.getElementById('alamat').value && document.getElementById('no_hp_alternatif').value && document.getElementById('kendala').value && document.getElementById('imei').value) { printDiv('spk-print'); }"  --}} type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Cek
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($isFind == 1)

    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full sm:max-w-2xl relative max-h-[80vh] overflow-y-auto">
            {{-- Header --}}
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-lg font-semibold text-gray-800">Detail Pemesanan & Garansi</h2>
                <button wire:click="$set('isFind', 0)" class="text-gray-500 hover:text-gray-800">
                    ✖
                </button>
            </div>

            {{-- Notifikasi Garansi --}}
            @if (isset($warantyMsg))
                <div class="mt-4 p-3 bg-blue-100 border-l-4 border-blue-500 text-blue-700 rounded">
                    <p class="text-sm font-medium">{{ $warantyMsg }}</p>
                </div>
            @endif

            {{-- Informasi Pemesanan --}}
            <div class="mt-4 grid grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <p class="font-semibold">Kode Pesanan:</p>
                    <p class="text-gray-600">{{ $oldBooking->kode_pesanan }}</p>
                </div>
                <div>
                    <p class="font-semibold">Waktu pesanan:</p>
                    <p class="text-gray-600">{{ $oldBooking->created_at }}</p>
                </div>
                <div>
                    <p class="font-semibold">Jenis Garansi:</p>
                    @if ($oldBooking->garansi == 0)
                    <p class="text-gray-600">Tidak Garansi</p>
                    @endif

                    @if ($oldBooking->garansi == 1)
                    <p class="text-gray-600">Garansi 14 Hari</p>
                    @endif

                    @if ($oldBooking->garansi == 2)
                    <p class="text-gray-600">Garansi 30 Hari</p>
                    @endif

                    @if ($oldBooking->garansi == 3)
                    <p class="text-gray-600">Garansi 90 Hari</p>
                    @endif
                </div>
                <div>
                    <p class="font-semibold">Nama Customer:</p>
                    <p class="text-gray-600">{{ $oldBooking->customer->nama }}</p>
                </div>
                <div>
                    <p class="font-semibold">Alamat:</p>
                    <p class="text-gray-600">{{ $oldBooking->customer->alamat }}</p>
                </div>
                <div>
                    <p class="font-semibold">No HP:</p>
                    <p class="text-gray-600">{{ $oldBooking->customer->no_hp }}</p>
                </div>
                <div>
                    <p class="font-semibold">Nama Teknisi:</p>
                    <p class="text-gray-600">{{ $oldBooking->teknisi->nama }}</p>
                </div>
                <div>
                    <p class="font-semibold">HP:</p>
                    <p class="text-gray-600">{{ $oldBooking->hpModel->hpMerk->merk }} {{ $oldBooking->hpModel->model }}</p>
                </div>
                <div>
                    <p class="font-semibold">kendala lama:</p>
                    <p class="text-gray-600">{{ $oldBooking->kendala }}</p>
                </div>
            </div>

            {{-- Detail Service --}}
            <div class="mt-4">
                <p class="font-semibold">Detail Service:</p>
                <ul class="text-gray-600 list-disc ml-5">
                    @foreach ($oldBooking->detailBooking as $item)
                        <li>{{ $item->dataService->nama_servis}}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Sparepart --}}
            <div class="mt-4">
                <p class="font-semibold">Sparepart Digunakan:</p>
                <ul class="text-gray-600 list-disc ml-5">
                    @foreach ($oldBooking->sparepart_booking as $item)
                        <li>{{ $item->sparepart->nama_sparepart }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Form Klaim Garansi --}}
            @if ($isWaranty == 1)
                <div class="mt-6 border-t pt-4">
                    <form wire:submit.prevent="claim">
                        <label for="kendala" class="block text-sm font-medium text-gray-700">Masukkan Kendala baru:</label>
                        <input type="text" id="kendala" wire:model="kendala"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">

                        {{-- Error message --}}
                        @if ($errors->has('kendala'))
                            <div class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('kendala')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <button type="submit"
                            class="mt-4 w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                            Buat Klaim Garansi
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endif


    {{-- DESAI STRUK SPK --}}

    <div class="bg-white rounded shadow-md p-4 my-3 w-10" id="spk-claim-print" style="width:80mm;display:none">
        <div class="struk-header">
            <div class="logo-center justify-center text-center">
                <img src="{{ asset('images/logo_raja.png') }}" alt="logo" class="w-20 h-20 mx-auto">
            </div>
            <div class="address-center text-center">
                <h1 class="text-2xl font-bold pb-3">Raja Servis HP</h1>
                <p class="text-sm pb-2 px-4">Jl. Raya Kedung Turi No. 1, Kedung Turi, Kec. Sidoarjo, Kabupaten
                    Sidoarjo,
                    Jawa Timur
                    61257</p>
                <p class="text-sm font-bold">Telp. 0812-3456-7890</p>
            </div>
            <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 20px 0;">
            <div class="text-center">
                <h3 class="text-l font-bold pb-3">#kodepemesanan</h3>
                <h3 class="text-l ">Pemesanan: 12-20-2024</h3>
            </div>

            <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 20px 0;">

            <div class="flex justify-center">
                <table>
                    <tr>
                        <td class="px-4 py-2">Nama</td>
                        <td class="px-4 py-2">
                            {{ session('inputData')['customer_id'] ?? '' }}
                            {{-- : {{ $booking->customer->nama }} --}}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">No.HP</td>
                        <td class="px-4 py-2">
                            {{ session('inputData')['user_id'] ?? '' }}
                            {{-- : {{ $booking->customer->no_hp }} --}}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Kendala</td>
                        <td class="px-4 py-2">
                            {{ session('inputData')['kendala'] ?? '' }}
                            {{-- : {{ $booking->kendala }} --}}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2">Teknisi</td>
                        <td class="px-4 py-2">
                            {{ session('inputData')['teknisi_id'] ?? '' }}
                            {{-- : {{ $booking->teknisi->nama }} --}}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2"></td>
                        <td class="px-4 py-2">
                            {{-- : {{ $booking->teknisi->no_hp }} --}}
                        </td>
                    </tr>
                </table>

            </div>


            <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 5px 0;">
            <div class="text-center py-2">
                <h2 class="text-l font-semibold ">Kendala:</h2>
                <p class="px-3 pb-4">Hp tidak mau menyala dan boot loop terus, pin password lupa, pengguna juga tidak
                    paham
                </p>
                <h2 class="text-s font-semibold pb-4">Teknisi : Subagiyo kirun</h2>
                <h2 class="text-l font-bold ">Nomor Urut</h2>
                <h2 class="text-7xl font-bold ">07</h2>
            </div>


            <hr style="border: none; border-top: 2px dashed rgba(0, 0, 0, 0.413); margin: 20px 0;">
            <h2 class="text-center text-2xl py-2 text-l font-semibold ">Terimakasih</h2>
        </div>
    </div>



</div>


<script>
    window.addEventListener('print-claim-spk', () => {
        printDiv('spk-claim-print');
    });

    function printDiv(divId) {
        let printContent = document.getElementById(divId).innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent; // Hanya menampilkan elemen yang dipilih
        window.print(); // Perintah print
        document.body.innerHTML = originalContent; // Mengembalikan halaman ke tampilan awal

    }
</script>
