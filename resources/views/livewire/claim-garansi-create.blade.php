<div>
    <div class="inset-0 z-50 flex items-center justify-center bg-opacity-50 m-6">
        <div class="bg-white p-10 rounded-lg shadow-lg w-200 flex">

            <div class="w-1/3">
                <div class="flex justify-center">
                    <img src="{{ asset('images/garansi.png') }}" alt="Edit Teknisi"
                        class="w-35 object-cover rounded-l-lg">
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
                    <img src="{{ asset('images/Reset.svg') }}" alt="Edit Teknisi"
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
    {{-- notif info garansi --}}
        @if (isset($warantyMsg))
            <div class="p-4 mb-4 text-blue-700 bg-blue-100 rounded">
                {{ $warantyMsg }}
            </div>
        @endif
        <div class="inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-10 rounded-lg shadow-lg w-200 flex">
                {{ $oldBooking }}
                {{-- tampilkan detail booking koyo nde detail booking, tambahi keterangan, tambahi claim (isine angka berapa kali nota iki diclaim garansi e)--}}
                @foreach ($oldBooking->sparepart_booking as $item)
                    {{$item}}
                @endforeach 
                {{-- gawe relation $oldbooking->[namaModels relation yang dituju] --}}
                
            </div>
            
            
        </div>
        {{-- cek ketika garansi aktif akan ada tombol dan sebaliknya  --}}
        @if ($isWaranty ==1)  
        <form wire:submit.prevent="claim">
            <div class="">
                <label for="kendala" class="block text-sm font-medium text-gray-400">Kendala</label>
                <input type="text" id="kendala" wire:model="kendala"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @if ($errors->has('kendala'))
                    <div
                        class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
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
            </div>
        <div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Buat claim garansi
            </button>
        </div>
    </form>
        @endif
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
                                {{ session('inputData')['customer_id'] ?? ''}}
                                {{-- : {{ $booking->customer->nama }} --}}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">No.HP</td>
                            <td class="px-4 py-2">
                                {{ session('inputData')['user_id'] ?? ''}}
                                {{-- : {{ $booking->customer->no_hp }} --}}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Kendala</td>
                            <td class="px-4 py-2">
                                {{ session('inputData')['kendala'] ?? ''}}
                                {{-- : {{ $booking->kendala }} --}}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Teknisi</td>
                            <td class="px-4 py-2">
                                {{ session('inputData')['teknisi_id'] ?? ''}}
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
