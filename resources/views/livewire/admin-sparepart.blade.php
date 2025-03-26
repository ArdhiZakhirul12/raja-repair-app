<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold mx-4 px-10 my-4">
        Tambah Sparepart
    </h1>
    
    <div class="px-10 w-400 flex mx-4 mb-4 items-start gap-4">

        <div class="w-1/2  ">

            @if (session()->has('message'))
            <div class="mt-2 p-2 bg-green-500 text-white">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form wire:submit.prevent="submit">

                <div class="p-3 bg-white border border-gray-300 rounded shadow-md">
                    <div class="flex items-center">
                        <img src="{{ asset('images/Analyze.svg') }}" alt="logo" class="w-8 mr-2">
                        <h2 class="text-xl font-semibold">Detail</h2>
                    </div>
                    <hr class="my-3">
                    <div class="mb-4">
                        <label for="nama_sparepart" class="block text-sm font-medium text-gray-400">Nama Sparepart</label>
                        <input type="text" name="nama_sparepart" id="nama_sparepart" wire:model="nama_sparepart"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="code_sparepart" class="block text-sm font-medium text-gray-400">Kode Sparepart</label>
                        <input type="text" name="code" id="code" wire:model="code"
                            class="mt-1 p-2 w-full border border-gray-300 rounded" required>
                    </div>

                    
                    <div class="mb-4 flex gap-4">
                        <div class="w-1/2">
                            <label for="harga" class="block text-sm font-medium text-gray-400">Harga</label>
                            <input type="text" name="harga" id="harga" wire:model="harga"
                                class="mt-1 p-2 w-full border border-gray-300 rounded" required  oninput="formatRupiah(this)">
                        </div>
                        
                    </div>

                    
                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2"
                        onclick="document.getElementById('add-service-modal').classList.add('hidden')">Kembali</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                </div>
            </form>

        </div>



        {{-- HARGA CABANG --}}

        <div class="w-1/2 p-3 ml-3 bg-white border border-gray-300 rounded shadow-md">

            <div class="flex items-center">
                <img src="{{ asset('images/business_building.svg') }}" alt="logo" class="w-8 mr-2">
                <h2 class="text-xl font-semibold">Harga Cabang</h2>
            </div>
            <hr class="my-3">
            {{-- <div class="flex items-center justify-between">
               
                <x-dropdown-list :items="['Cabang Surabaya', 'Cabang Bandung']" />
            </div> --}}
{{-- 
            <div >
                <div class="overflow-y-auto max-h-[525px] p-3 border border-gray-300 rounded shadow-md"> --}}
                    @foreach ($cabangs as $cabang)
                        <div class="mb-4 p-3 border border-gray-300 rounded shadow-md">
                            <label class="font-semibold">Cabang {{ $cabang->nama }}</label>
            
                            <div class="grid grid-cols-2 gap-4 mt-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Harga </label>
                                    <input type="text" wire:model="harga_khusus.{{ $cabang->user->id }}" 
                                           class="p-2 w-full border rounded" placeholder="Masukkan harga" oninput="formatRupiah(this)"
                                          >
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                {{-- </div> --}}
            
                {{-- Tombol Simpan --}}
                {{-- <button wire:click="save" class="mt-3 p-2 bg-blue-500 text-white rounded">Simpan</button> --}}
            
                {{-- Notifikasi --}}
            {{-- </div> --}}
            













        </div>
    </div>
</div>


<script>

function formatRupiah(angka){
    value = angka.value.replace(/\D/g, "");

    if(value === ""){
        angka.value = "";
        return "";
    }
    console.log(value);

    let reverse = value.split('').reverse().join('');
    let formatted = reverse.match(/\d{1,3}/g).join('.').split('').reverse().join('');
    // formatted = formatted;
    angka.value = formatted;
}

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".accordion-header").forEach(header => {
            header.addEventListener("click", function() {
                const target = document.querySelector(this.getAttribute(
                    "data-accordion-target"));
                if (target) {
                    target.classList.toggle("hidden"); // Toggle visibility
                }
            });
        });
    });
</script>
