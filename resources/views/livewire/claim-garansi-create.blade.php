<div>
    <div class="inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-10 rounded-lg shadow-lg w-200 flex">

            <div class="w-1/2">
                <div class="flex justify-center">
                    <img src="{{ asset('images/create_data.png') }}" alt="Edit Teknisi"
                        class="h-42 w-42 object-cover rounded-l-lg">
                </div>
                <p class="text-center text-sm  px-10 text-gray-400">Pastikan data yang ada masukkan sudah benar dan
                    tidak ada form yang kosong</p>
            </div>
            <div class="w-1/2 p-4">
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
                <h2 class="text-xl font-semibold mb-4">Claim Garansi</h2>
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
                    <div class="">
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

</div>
