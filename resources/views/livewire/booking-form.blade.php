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

        <!-- Dropdown Teknisi -->
        <div x-data="{ open: false, search: '', teknisis: @entangle('teknisis') || [] }">
            <label for="teknisi_id" class="block text-sm font-medium text-gray-700">Pilih Teknisi</label>
            <input 
                type="text" 
                x-model="search" 
                x-on:click="open = !open" 
                x-on:input="open = true" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                placeholder="Cari teknisi...">
        
            <!-- Dropdown -->
            <div x-show="open" x-transition x-on:click.away="open = false" class="mt-2 w-full max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                <ul>
                    <template x-for="teknisi in (teknisis && teknisis.filter(t => t.nama.toLowerCase().includes(search.toLowerCase()))) || []" :key="teknisi.id">
                        <li x-on:click="search = teknisi.nama; open = false" class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                            <span x-text="teknisi.nama"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
        

        <!-- Input Kendala -->
        <div>
            <label for="kendala" class="block text-sm font-medium text-gray-700">Kendala</label>
            <textarea id="kendala" wire:model="kendala" rows="5"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
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
