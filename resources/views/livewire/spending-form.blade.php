<div>
    @if (session()->has('doneMsg'))
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50" id="popup">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Notifikasi</h3>
                    <button onclick="document.getElementById('popup').style.display='none'"
                        class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <p class="mt-4 text-gray-700">{{ session('doneMsg') }}</p>
                <div class="mt-6 flex justify-end">
                    {{-- <button wire:click="closeAndPrint" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Tutup
                </button> --}}
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6 mb-5 mt-2">
        <div class="flex justify-center">
            <div class="max-w-4xl mx-3 p-6 bg-white shadow-md rounded-lg">
                <div class="flex items-center mb-2">
                    <img src="{{ asset('images/save_out.svg') }}" alt="logo" class="w-8 mr-2">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-100">Data Kas/Bank Keluar</h3>
                </div>
                <hr class="mb-4">
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex">
                        {{-- <div class="mr-2">
                            <label for="dokumen" class="block text-sm font-medium text-gray-400">Dokumen</label>
                            <input type="file" wire:model="dokumen" id="dokumen" name="dokumen"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div> --}}
                        {{-- <div class="mr-2">
                            <label for="#dokumen" class="block text-sm font-medium text-gray-400">#Dokumen</label>
                            <input type="text" wire:model="#dokumen" id="#dokumen" name="#dokumen"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div> --}}
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-400">Tanggal</label>
                            <input type="date" wire:model="tanggal" id="tanggal" name="tanggal"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mr-2">
                            <label for="referensi" class="block text-sm font-medium text-gray-400"># Referensi</label>
                            <input type="text" wire:model="referensi" id="referensi" name="referensi" value=""
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        {{-- <div class="mr-2">
                            <label for="mata_uang" class="block text-sm font-medium text-gray-400">Mata Uang</label>
                            <input type="text" wire:model="mata_uang" id="mata_uang" name="mata_uang"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div> --}}
                        {{-- <div>
                            <label for="total" class="block text-sm font-medium text-gray-400">Total</label>
                            <input type="number" wire:model="total" id="total" name="total" value="0.00"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                        </div> --}}
                    </div>

                    {{-- @dd($metodePembayaran) --}}
                    {{-- <div>
                        <label for="sub_account" class="block text-sm font-medium text-gray-400">Sub Account</label>
                        <div class="flex">
                            <input type="text" wire:model="sub_account" id="sub_account" name="sub_account"
                                class="mt-1 mr-2 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <input type="text" wire:model="sub_account_long" id="sub_account_long"
                                name="sub_account_long"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>


                        @if ($errors->has('sub_account'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('sub_account')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div> --}}

                    {{-- <div class="flex">
                        <div class="mr-2">
                            <label for="lokasi" class="block text-sm font-medium text-gray-400">Lokasi</label>
                            <input type="text" wire:model="lokasi" id="lokasi" name="lokasi" value="ACC"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if ($errors->has('lokasi'))
                                <div
                                    class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                    </svg>
                                    @error('lokasi')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        <div>

                            <label for="PCC" class="block text-sm font-medium text-gray-400">PCC</label>
                            <input type="text" wire:model="PCC" id="PCC" name="PCC"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if ($errors->has('PCC'))
                                <div
                                    class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                    </svg>
                                    @error('PCC')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>

                    </div> --}}



                    {{-- <div>
                        <label for="BPL" class="block text-sm font-medium text-gray-400">BPL</label>
                        <input type="text" wire:model="BPL" id="BPL" name="BPL"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @if ($errors->has('BPL'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('BPL')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div> --}}

                    <div class="flex">
                        <div class="mr-2">
                            <label for="cara_bayar" class="block text-sm font-medium text-gray-400">Cara Bayar</label>
                            <select id="dataDropdown" name="dataDropdown"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                wire:model="selectedMetode">>
                                <option selected>Pilih Cara Bayar</option>
                                @foreach ($metodePembayaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->metode }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('cara_bayar'))
                                <div
                                    class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                    </svg>
                                    @error('cara_bayar')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        {{-- <div>
                            <label for="bank" class="block text-sm font-medium text-gray-400">bank</label>
                            <input type="text" wire:model="bank" id="bank" name="bank"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @if ($errors->has('bank'))
                                <div
                                    class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                    </svg>
                                    @error('bank')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div> --}}
                    </div>

                    <div class="flex">
                        <div class="mr-2">
                            <label for="harga" class="block text-sm font-medium text-gray-400">Harga</label>
                            <input type="text" wire:model.lazy="harga" id="harga" name="harga"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                onkeyup="formatRupiah(this)" oninput="updateHiddenInput(this)">
                            <input type="hidden" id="hargaHidden" name="harga_real">


                            @if ($errors->has('harga'))
                                <div
                                    class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                    </svg>
                                    @error('harga')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        {{-- <div>
                            <label for="kurs" class="block text-sm font-medium text-gray-400">Kurs</label>
                            <input type="number" wire:model="kurs" id="kurs" name="kurs" value="1.00"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">
                            
                        </div> --}}
                    </div>






                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-400">Jumlah</label>
                        <input type="number" wire:model="jumlah" id="jumlah" name="jumlah" value="0"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">

                    </div>
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-400">Keterangan</label>
                        <textarea type="text" wire:model="keterangan" id="keterangan" name="keterangan" rows="4"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
    </form>
    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/\./g, '').replace(/\D/g, ''); // Hanya angka
        if (value) {
            input.value = new Intl.NumberFormat('id-ID').format(value); // Format angka
        }
        updateHiddenInput(input); // Perbarui nilai asli tanpa titik
    }

    function updateHiddenInput(input) {
        document.getElementById('hargaHidden').value = input.value.replace(/\./g, '');
    }
</script>
