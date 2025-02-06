<div>


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
                        <div class="mr-2">
                            <label for="dokumen" class="block text-sm font-medium text-gray-400">Dokumen</label>
                            <input type="file" wire:model="dokumen" id="dokumen" name="dokumen" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div  class="mr-2">
                            <label for="#dokumen" class="block text-sm font-medium text-gray-400">#Dokumen</label>
                            <input type="text" wire:model="#dokumen" id="#dokumen" name="#dokumen" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-400">Tanggal</label>
                            <input type="date" wire:model="tanggal" id="tanggal" name="tanggal" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="flex">
                        <div  class="mr-2">
                            <label for="referensi" class="block text-sm font-medium text-gray-400"># Referensi</label>
                            <input type="text" wire:model="referensi" id="referensi" name="referensi" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div  class="mr-2">
                            <label for="mata_uang" class="block text-sm font-medium text-gray-400">Mata Uang</label>
                            <input type="text" wire:model="mata_uang" id="mata_uang" name="mata_uang" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="total" class="block text-sm font-medium text-gray-400">Total</label>
                            <input type="number" wire:model="total" id="total" name="total" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            
                        </div>
                    </div>
           
     
                    <div>
                        <label for="sub_account" class="block text-sm font-medium text-gray-400">Sub Account</label>
                        <div class="flex">
                            <input type="text" wire:model="sub_account" id="sub_account" name="sub_account" class="mt-1 mr-2 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <input type="text" wire:model="sub_account_long" id="sub_account_long" name="sub_account_long" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                                 
                        @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="flex">
                        <div  class="mr-2">
                            <label for="lokasi" class="block text-sm font-medium text-gray-400">Lokasi</label>
                            <input type="text" wire:model="lokasi" id="lokasi" name="lokasi" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                     
                            <label for="PCC" class="block text-sm font-medium text-gray-400">PCC</label>
                            <input type="text" wire:model="PCC" id="PCC" name="PCC" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                      
                    </div>


                  
                    <div>
                        <label for="BPL" class="block text-sm font-medium text-gray-400">BPL</label>
                        <input type="text" wire:model="BPL" id="BPL" name="BPL" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="flex">
                        <div  class="mr-2">
                            <label for="cara_bayar" class="block text-sm font-medium text-gray-400">Cara Bayar</label>
                            <input type="text" wire:model="cara_bayar" id="cara_bayar" name="cara_bayar" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="bank" class="block text-sm font-medium text-gray-400">bank</label>
                            <input type="text" wire:model="bank" id="bank" name="bank" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mr-2">
                            <label for="mata_uang" class="block text-sm font-medium text-gray-400">Mata Uang</label>
                            <input type="text" wire:model="mata_uang" id="mata_uang" name="mata_uang" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="Kurs" class="block text-sm font-medium text-gray-400">Kurs</label>
                            <input type="text" wire:model="Kurs" id="Kurs" name="Kurs" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>




                    
                
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-400">Jumlah</label>
                        <input type="number" wire:model="jumlah" id="jumlah" name="jumlah" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">

                    </div>
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-400">Keterangan</label>
                        <input type="text" wire:model="keterangan" id="keterangan" name="keterangan" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
            </div>
        </div>
    </form>
    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
