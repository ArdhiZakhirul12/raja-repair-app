
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Booking</h1>
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @endif
    @if (isset($feedbackMessage))
        <div class="p-4 mb-4 text-blue-700 bg-blue-100 rounded">
            {{ $feedbackMessage }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Input Nomor HP -->
        <div>
            <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
            <input type="text" id="nohp" wire:model="nohp"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Input Nama -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="nama" wire:model="nama"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Input Alamat -->
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea id="alamat" wire:model="alamat" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>

        <!-- Input No HP Alternatif -->
        <div>
            <label for="no_hp_alternatif" class="block text-sm font-medium text-gray-700">No Hp Alternatif</label>
            <input type="text" id="no_hp_alternatif" wire:model="no_hp_alternatif"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Dropdown Menu Teknisi -->
        <div x-data="{ open: false, search: '', items: ['Sugeng','Praz','Budi','echo codox'] }">
            <label for="dropdown" class="block text-sm font-medium text-gray-700">Pilih Teknisi</label>
            <input 
                type="text" 
                x-model="search" 
                x-on:click="open = !open" 
                x-on:input="open = true" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                placeholder="Cari Teknisi...">
            
            <!-- Dropdown -->
            <div x-show="open" x-transition x-on:click.away="open = false" class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                <ul>
                    <template x-for="item in items.filter(i => i.toLowerCase().includes(search.toLowerCase()))" :key="item">
                        <li x-on:click="search = item; open = false" class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                            <span x-text="item"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

                <!-- Dropdown Menu Merk -->
                <div x-data="{ open: false, search: '', items: ['xiaomi','samsung','oppo','smarfrend','iphone'] }">
                    <label for="dropdown" class="block text-sm font-medium text-gray-700">Pilih Merk HP</label>
                    <input 
                        type="text" 
                        x-model="search" 
                        x-on:click="open = !open" 
                        x-on:input="open = true" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                        placeholder="Cari Merk...">
                    
                    <!-- Dropdown -->
                    <div x-show="open" x-transition x-on:click.away="open = false" class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                        <ul>
                            <template x-for="item in items.filter(i => i.toLowerCase().includes(search.toLowerCase()))" :key="item">
                                <li x-on:click="search = item; open = false" class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                                    <span x-text="item"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>



                        <!-- Dropdown Menu Model-->
        <div x-data="{ open: false, search: '', items: ['Mode 1', 'Mode 2', 'Mode 3', 'Mode 4'] }">
            <label for="dropdown" class="block text-sm font-medium text-gray-700">Pilih Model HP</label>
            <input 
                type="text" 
                x-model="search" 
                x-on:click="open = !open" 
                x-on:input="open = true" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                placeholder="Cari Model...">
            
            <!-- Dropdown -->
            <div x-show="open" x-transition x-on:click.away="open = false" class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                <ul>
                    <template x-for="item in items.filter(i => i.toLowerCase().includes(search.toLowerCase()))" :key="item">
                        <li x-on:click="search = item; open = false" class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                            <span x-text="item"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>





                        <!-- Input Imei-->
        <div>
            <label for="imei" class="block text-sm font-medium text-gray-700">Imei</label>
            <input type="text" id="imei" wire:model="imei"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        
        

        <!-- Input Kendala -->
        <div>
            <label for="kendala" class="block text-sm font-medium text-gray-700">Kendala</label>
            <textarea id="kendala" wire:model="kendala" rows="5"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>

        

        <label for="fruits">Service</label>
<select id="Service" name="service" data-placeholder="Select Services" multiple data-multi-select>
    <option value="Ganti Layar">Ganti Layar</option>
    <option value="Install OS">Install OS</option>
    <option value="Pasang Anti Gores">Pasang Anti Gores</option>

</select>
<label for="fruits">Sparepart</label>
<select id="Sparepart" name="sparepart" data-placeholder="Select Spareparts" multiple data-multi-select>
    <option value="Baterai 50000Mah">Baterai 50000Mah</option>
    <option value="Layar Samsung">Layar Samsung</option>
    <option value="Busi">Busi</option>

</select>


<div id="garansi_check" class="flex items-center">
    <input type="checkbox"> 
    <label for="garansi_check" class="ml-2">Garansi</label>
</div>

        {{-- <div x-data="{ open: false, selectedItems: [] }" @click.away="open = false">
            <div class="selected-items">
            <template x-for="item in selectedItems" :key="item">
                <div x-text="item" class="bg-blue-100 rounded px-2 py-1 mb-1"></div>
            </template>
            </div>
                        <div class="dropdown">
                            <button @click="open = !open">
                                <input 
                                    type="text" 
                                    x-model="search" 
                                    x-on:click="open = !open" 
                                    x-on:input="open = true" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                    placeholder="Cari teknisi...">
                            </button>
                            <div x-show="open" class="dropdown-content mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                                <template x-for="option in ['Option 1', 'Option 2', 'Option 3'].filter(option => option.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                    <label class="block">
                                        <input type="checkbox" :value="option" @change="toggleItem($event, selectedItems)"> 
                                        <span x-text="option"></span>
                                    </label>
                                </template>
                            </div>
                        </div>
        </div>
        <script>
            function toggleItem(event, selectedItems) {
                const text = event.target.value;
                const index = selectedItems.indexOf(text);
    
                if (event.target.checked) {
                    if (index === -1) {
                        selectedItems.push(text);
                    }
                } else {
                    if (index !== -1) {
                        selectedItems.splice(index, 1);
                    }
                }
            }
        </script> --}}




        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Simpan
            </button>
        </div>

    </form>
</div>

<script>
    window.addEventListener('customer-not-found', event => {
        alert(event.detail.message);
    });
</script>
