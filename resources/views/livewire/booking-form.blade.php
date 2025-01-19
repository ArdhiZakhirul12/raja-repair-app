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


        <div x-data="{
            open: false,
            search: '',
            items: @js($teknisis),
            selectItem(item) {
                this.search = item.nama;
                @this.set('teknisiId', item.id);
                this.open = false;
            }
        }">
            <label for="dropdown" class="block text-sm font-medium text-gray-700">Pilih Teknisi</label>
            <input type="text"  x-model="search" x-on:click="open = !open" x-on:input="open = true"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Cari Teknisi...">

            <!-- Dropdown -->
            <div x-show="open" x-transition x-on:click.away="open = false"
                class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                <ul>
                    <template x-for="item in items.filter(i => i.nama.toLowerCase().includes(search.toLowerCase()))"
                        :key="item.id">
                        <li x-on:click="selectItem(item)"
                            class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                            <span x-text="item.nama"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>


        <div x-data="{
            openMerk: false,
            searchMerk: @entangle('searchMerk'),
            merkHpId: @entangle('merkHpId'),
            openModel: false,
            searchModel: @entangle('searchModel'),
            modelHpId: @entangle('modelHpId'),
            itemsMerk: @js($merks),
            itemsModel: @js($models),
            filteredModels() {
                return this.itemsModel.filter(i => i.hp_merk_id === this.merkHpId);
            },
            selectMerk(item) {
                this.searchMerk = item.merk;
                @this.set('merkHpId', item.id);
                this.openMerk = false;
            },
            selectModel(item) {
                this.searchModel = item.model;
                @this.set('modelHpId', item.id);
                this.openModel = false;
            }
        }">
            <!-- Dropdown Merk HP -->
            <label for="dropdown" class="block text-sm font-medium text-gray-700">Pilih Merk HP</label>
            <input type="text" x-model="searchMerk" x-on:click="openMerk = !openMerk" x-on:input="openMerk = true"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Cari Merk Hp...">
        
            <!-- Dropdown Merk -->
            <div x-show="openMerk" x-transition x-on:click.away="openMerk = false"
                class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                <ul>
                    <template x-for="item in itemsMerk.filter(i => i.merk.toLowerCase().includes(searchMerk.toLowerCase()))"
                        :key="item.id">
                        <li x-on:click="selectMerk(item)"
                            class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                            <span x-text="item.merk"></span>
                        </li>
                    </template>
                </ul>
            </div>
        
            <!-- Dropdown Model HP -->
            <label for="dropdown" class="block text-sm font-medium text-gray-700 mt-4">Pilih Model HP</label>
            <input type="text" x-model="searchModel" x-on:click="openModel = !openModel" x-on:input="openModel = true"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Cari Model Hp..." :disabled="!merkHpId">
        
            <!-- Dropdown Model -->
            <div x-show="openModel && merkHpId" x-transition x-on:click.away="openModel = false"
                class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                <ul>
                    <template x-for="item in filteredModels().filter(i => i.model.toLowerCase().includes(searchModel.toLowerCase()))"
                        :key="item.id">
                        <li x-on:click="selectModel(item)"
                            class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                            <span x-text="item.model"></span>
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


        <div x-data="{
            open: false,
            search: '',
            selectedItems: [], // Menyimpan layanan yang dipilih
            items: @js($services), // Data layanan yang dikirim dari controller
            selectItem(item) {
                // Cek jika item sudah ada di selectedItems, jika sudah, hapus
                if (this.selectedItems.some(i => i.id === item.id)) {
                    this.selectedItems = this.selectedItems.filter(i => i.id !== item.id);
                } else {
                    // Tambahkan item yang dipilih ke selectedItems
                    this.selectedItems.push(item);
                }
                // Set state untuk mengupdate input field
                this.search = '';
                @this.set('service_id', this.selectedItems.map(i => i.id)); // Kirim array ID ke Livewire
                @this.set('harga_service', this.selectedItems.map(i => i.harga)); // Kirim array ID ke Livewire
                this.open = false;
            },
            get displayText() {
                // Menampilkan nama-nama layanan yang dipilih
                return this.selectedItems.map(i => i.nama_servis).join(', ') || 'Pilih Layanan';
            }
        }">
        <label for="dropdown" class="block text-sm font-medium text-gray-700">Pilih Layanan</label>
        <input type="text" x-model="search" x-on:click="open = !open" x-on:input="open = true"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            placeholder="Cari Layanan..." :value="displayText" readonly>
    
        <!-- Dropdown -->
        <div x-show="open" x-transition x-on:click.away="open = false"
            class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
            <ul>
                <template x-for="item in items.filter(i => i.nama_servis.toLowerCase().includes(search.toLowerCase()))" :key="item.id">
                    <li x-on:click="selectItem(item)"
                        :class="{'bg-indigo-600 text-white': selectedItems.some(i => i.id === item.id)}"
                        class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                        <span x-text="item.nama_servis"></span>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    <div x-data="{
        open: false,
        search: '',
        selectedItems: [], // Menyimpan sparepart yang dipilih
        items: @js($spareparts), // Data sparepart yang dikirim dari controller
        selectItem(item) {
            // Cek jika item sudah ada di selectedItems, jika sudah, hapus
            if (this.selectedItems.some(i => i.id === item.id)) {
                this.selectedItems = this.selectedItems.filter(i => i.id !== item.id);
            } else {
                // Tambahkan item yang dipilih ke selectedItems
                this.selectedItems.push(item);
            }
            // Set state untuk mengupdate input field
            this.search = '';
            @this.set('sparepart_id', this.selectedItems.map(i => i.id)); // Kirim array ID ke Livewire
            @this.set('harga_sparepart', this.selectedItems.map(i => i.harga)); // Kirim array ID ke Livewire

            this.open = false;
        },
        get displayText() {
            // Menampilkan nama-nama sparepart yang dipilih
            return this.selectedItems.map(i => i.nama_sparepart).join(', ') || 'Pilih Sparepart';
        }
    }">
    <label for="dropdown" class="block text-sm font-medium text-gray-700">Pilih Sparepart</label>
    <input type="text" x-model="search" x-on:click="open = !open" x-on:input="open = true"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="Cari Sparepart..." :value="displayText" readonly>

    <!-- Dropdown -->
    <div x-show="open" x-transition x-on:click.away="open = false"
        class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
        <ul>
            <template x-for="item in items.filter(i => i.nama_sparepart.toLowerCase().includes(search.toLowerCase()))" :key="item.id">
                <li x-on:click="selectItem(item)"
                    :class="{'bg-indigo-600 text-white': selectedItems.some(i => i.id === item.id)}"
                    class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                    <span x-text="item.nama_sparepart"></span>
                </li>
            </template>
        </ul>
    </div>
</div>

    
        {{-- <div>
            <label for="service">Service</label>
            <select id="Service" name="service" wire:model="service_id" data-placeholder="Select Services" multiple
                data-multi-select>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->nama_servis }}</option>
                @endforeach
            </select>
        
            <label for="sparepart">Sparepart</label>
            <select id="Sparepart" name="sparepart" wire:model="sparepart_id" data-placeholder="Select Spareparts"
                multiple data-multi-select>
                @foreach($spareparts as $sparepart)
                    <option value="{{ $sparepart->id }}">{{ $sparepart->nama_sparepart }}</option>
                @endforeach
            </select>
        </div> --}}
        


        <div id="garansi_check" class="flex items-center">
            <input type="checkbox" wire:model="garansi" value="1" id="garansi_check">
            <label for="garansi_check" class="ml-2">Garansi</label>
        </div>
        

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
