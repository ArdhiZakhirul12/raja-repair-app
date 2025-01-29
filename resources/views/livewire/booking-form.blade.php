<style>
    @media print {
        /* Atur ukuran kertas menjadi Legal (216mm x 356mm) */
        @page {
            size: Legal;
            margin: 10mm; /* Sesuaikan margin sesuai kebutuhan */
        }

        /* Sesuaikan elemen agar mengikuti ukuran kertas */
        body {
            transform: scale(1.4); /* Skala 140% */
            transform-origin: top left; /* Pastikan skala dari kiri atas */
        }

        /* Kontainer yang akan dicetak */
        #spk-print {
            width: 100%;
            margin: auto;
            overflow: hidden;
        }
    }
</style>
<div class=" my-4  mx-10 py-7 py-4 
{{-- shadow-md rounded-lg " --}}
">

    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="flex justify-center">
            <div class="max-w-4xl mx-3 p-6 bg-white shadow-md rounded-lg">

                <div class="flex ">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                        height="30" viewBox="0 0 30 30" fill="none">

                        <image id="image0_76_221" width="30" height="30"
                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFIUlEQVR4nO2dW2gcZRSAT70j3sUK3luf1Af1QXySKlqsSlGKS/acTVooGsEblpo9ZxrLKCqIPkhVhKCQdvc/G9k3KxXqrUXESlFUKlYRbQXFS9EH6yWmauTfbJqYmsskM/PP/jMfnJc87M7/8e+Z/3oCUFBQUFBQUFBQUFBQUBCNB4e6LuZ6Za0YekEUd4ji16L0Mxs6JIq/suJ++3dWfJgb5Ssjfny+CQd6T2RD97DiB6I0GiVY8Y1qo3yZ6zZkm1FYxIp3iKEDUQVPkf2HKFZcNyeTyJaeM1lx+0IET5H9Nxu61XW7MkW1XjmPFb+IS/LhsL8MQ/ez4sr1te7FkGdE6XRR/Cx2yUdKH2bFzX2N8jmQy5xsaFvikv8r/FupV66CPMGKq1OVPCH7p35DF0IeuO/VFcez4jdORNuXpaGdkAcCQ3e6kjwe1UZ5OfiOKO5yLVqUXgefWV/rXpwByTZ9HFrXLJ0BvhIo3uZa8kR4PINkxafcC273asWnwVdY8a0Mid4OvsKKe1wLnhRfgq+InZ25FzwWhg6Ar3BrGTMzoofBV9jQQeeCDwf+Ar7Chj53L3gs7LOAr3CMC/wxpI43wVdEcWOGRD8CviKN8tXOBbcjUFwGPsOG9rqWzIpfhWF4FPgMG3rWtWhRfA58JjB0nd2ldi26tVNer1wLviKGtrqWPEn2y+ArnKG1Djb0MfgKG3rPteCJwF3gK6I04F5wOww9D74iijc7FzwejfIK8BlWfMe1ZDb0rj3EAz7TX+teIoofOZOs+CEPdV0EeYEVNzmQvAnyBiuuTF10o3wL5I2wWTpOFH9ITbSh73oHeo+FPCJKnF6Pxnshz3dWxNC+FHLznnDHsmMgz1Qb5eVJLjR5v4AUBTb0UIK5OXDdvqzdynopAclD3k9MolJqlo6OeWw9kNtRxlyIS/ScvizPSCG6EO0V0oE9uu/FtSeLodDem2RDf7KhH+3LfYOhKyCrSIeJtiuB0x+hwBEx1ANZRDpItJU8+8wWR7jWfTlkiaBeuT4u0UG9ck0as1p7/He2Z7FpBDJVq0Oj1+mYoXG7w8E1JyT93FVDN80mmw19D1kgrFdOsYVN4pI8qYHbuFk61bVsewAfnDIKi4J65fYkryzbc3aBoVVJT8VnlG3oE3B3sRPvTvPAoz14zop9QaN89nxffLNdbZ5eNm6ENIugiC1WYminGPorLcH/0+gRm1Kqindt2Lz63EijC0PDVmYk2YY+DZulkyBJgnrlUrtMyYq7xdA/7uROE61nmvkG7RFDuCiyDe1LbMe9OtR1iSg9kaX7KjJ9OnlsXuPkuci2GxqxS7YvNUOrsnA4RpKWHEF2rFQVb7QnM12LkzQlpyk7HFxzmigOupYmMUu2pYAibRgnKbt/qOv8LNxFEdeSJ8uOu6qNKC1t1wl1Lk6yIHlMdLyji3bhqdjWIyStMPTkTO3iLT0X2GoH8/v8VqdbCnEihp5xLk097smtB6p1LxkrKexenvjaky32KoJzceq55PYZud+dy1NP08U4onSDa3nic0+eEI2Pdojkx2fryXZ9el6/EsX9iV/JEEOvdYDkrTMt7mdecku0w8s9MjfJw0GzdFZHS7a4rI4rc5PxSkfm5KlkfcTBhtZ1dE/udFixVkhOAVF6P/PpwpP/I3CwkJww7Zdg0ZPT2GIr0kUKSL3yQJGTM1OEpXjxLRhWfHua8fFvY7tEqHaNfeHflHPY0N627AE7obEVZ1oTEEf3Dv8FYD/aWmoSqxwAAAAASUVORK5CYII=" />

                    </svg>
                    <h3 class="font-bold text-gray-800 mb-6 mx-2 pt-2 ">Data Pelanggan</h3>
                </div>


                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                        {{ session('message') }}
                        {{ session('inputData')['kendala'] }}

                    </div>
                @endif
                @if (isset($feedbackMessage))
                    <div class="p-4 mb-4 text-blue-700 bg-blue-100 rounded">
                        {{ $feedbackMessage }}
                    </div>
                @endif


                <!-- Input Nomor HP -->
                <div class="flex space-x-4 mb-3">
                    <div class="w-1/2">
                        <label for="no_hp" class="block text-sm font-medium text-gray-400">Nomor HP</label>
                        <input type="text" id="nohp" wire:model="nohp"
                            class="input_group mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if ($errors->has('nohp'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('nohp')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Input Nama -->
                    <div class="w-1/2">
                        <label for="nama" class="block text-sm font-medium text-gray-400">Nama</label>
                        <input type="text" id="nama" wire:model="nama"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if ($errors->has('nama'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('nama')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Input Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="block text-sm font-medium text-gray-400">Alamat</label>
                    <textarea id="alamat" wire:model="alamat" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    @if ($errors->has('alamat'))
                        <div
                            class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                            </svg>
                            @error('alamat')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                </div>



                <!-- Input No HP Alternatif -->
                <div class="flex space-x-4 mb-3">


                    <div class="w-1/2" x-data="{
                        open: false,
                        search: '',
                        items: @js($teknisis),
                        selectItem(item) {
                            this.search = item.nama;
                            @this.set('teknisiId', item.id);
                            this.open = false;
                        }
                    }">
                        <label for="dropdown" class="block text-sm font-medium text-gray-400">Pilih Teknisi</label>
                        <input type="text" x-model="search" x-on:click="open = !open" x-on:input="open = true"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Cari Teknisi...">

                        <!-- Dropdown -->
                        <div x-show="open" x-transition x-on:click.away="open = false"
                            class="mt-2  max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                            <ul>
                                <template
                                    x-for="item in items.filter(i => i.nama.toLowerCase().includes(search.toLowerCase()))"
                                    :key="item.id">
                                    <li x-on:click="selectItem(item)"
                                        class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                                        <span x-text="item.nama"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                        @if ($errors->has('teknisiId'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('teknisiId')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                    </div>
                    @endif


                </div>
                <div class="w-1/2">
                    <label for="no_hp_alternatif" class="block text-sm font-medium text-gray-400">No Hp
                        Alternatif</label>
                    <input type="text" id="no_hp_alternatif" wire:model="no_hp_alternatif"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @if ($errors->has('no_hp_alternatif'))
                        <div
                            class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                            </svg>
                            @error('no_hp_alternatif')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>







            <!-- Input Kendala -->
            <div>
                <label for="kendala" class="block text-sm font-medium text-gray-400">Kendala</label>
                <textarea id="kendala" wire:model="kendala" rows="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
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
            {{-- <!-- Tombol Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Simpan
                        </button>
                    </div> --}}

            {{-- </form> --}}

        </div>



        <div>
            <div class="max-w-4xl mx-3 p-6 bg-white shadow-md rounded-lg">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                        height="30" viewBox="0 0 30 30" fill="none">

                        <image id="image0_76_220" width="30" height="30"
                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADZUlEQVR4nO2dsWpUQRiFB8So+AQm+AKCjU9ha/EfUwhapZCIViZWW7gzmyApLFNIwNJOUPEF1CgBIWwQbJx/USNYSURItTLXILjJ7t69O5s7x50D0ywL+32HyT83xXCNycnJyUkr1xufTovV23D+rVj/E067Ka3AJNZvwvpblx9+PGUYc/X+5/OwfrvuMlF+vZdmZ86w7WSykrt/y260ZwxL4PROAqV1qyxxftGwRKx/R1u09ZuGJXB+r+7CUHn5PcOS+svSsZZhSd1FIRettZc4FTvaJBYWTnoBkHDSC4CEk14AJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMKZnMC1B7tnxemqOP0m1n+B1RV50j2RGme01CEg1l+A053Dv+tbKXFGzXELSFNv9L26YXU3Fc7oGVVAGu2Z8GceSoHTr2EXlrlTEkYFnN/o93u56J4UJfcUJFafDyq7/6jIo6Pbr7SDndwtW/bAUfHvbn6UD8MSRRdlO/8yXD4K35O1zhlYXR9esP8lLV0wQzJ1MxrOtwYVJ05foOkvlRsVuhPGyiQ4/4/D0OmzEiUOm8cb4YCcFGdyqSIgxZOHf1qp4JKjIgZnUqkqINXK/iArnYvHyZlMxhGQUcq2+niUURGTM4mMKyDDyq44KmJz1p4YAtK/7MqjYhKctSaWgDTaM2K9C/+Wi/XfYf3aOKNiUpy1hUUAJJz0AiDhpBcACSe9AEg46QVAwkkvABJOegGQcNILgISTXgAknPQCIOGkFwAJJ70ASDjpBUDCSS8AEk56AZBw0guAhJNeACSc9AIg4aQXAAknvQBIOOkFQMI5sgBIlmFJ3UUhF621l5h3tBtawj6svzu/qrNhSUuXis9y0XF3mbR0qXdEidXlXHTkoq80/bneosNnuejIRc+v6uyhHd3szOWiY48Oq8tHPN3cy0XHP6T2Q9nFQfhnJ4eSp/0w5H3hjTj9YVhSvLougdJQZVl9bVgS3g9Ye2Gu6urcNCwJ14rDK+sId/PWwvrWScOUgwOLp2yrW0c9q1OkuIPi/KI4fZPmAen3xOmrMC7odnJOTo6ZgvwGAxegPr5PH1wAAAAASUVORK5CYII=" />

                    </svg>
                    <h3 class="font-bold text-gray-800 mb-6 mx-2 pt-2">Data Handphone</h3>
                </div>

                {{-- @if (session()->has('message') && $errors->isEmpty())
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (isset($feedbackMessage) && $errors->isEmpty())
                        <div class="p-4 mb-4 text-blue-700 bg-blue-100 rounded">
                            {{ $feedbackMessage }}
                        </div>
                        <div x-data="{ open: true }" x-show="open" x-transition>
                            <div class="p-4 mb-4 text-green-700 bg-white border border-green-500 rounded">
                                <div class="flex justify-between items-center">
                                    <span>Data berhasil disimpan!</span>
                                    <button @click="open = false" class="text-green-700 hover:text-green-900">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif --}}



                {{-- <form wire:submit.prevent="submit" class="space-y-6"> --}}

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

                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <!-- Dropdown Merk HP -->
                            <label for="dropdown" class="block text-sm font-medium text-gray-400">Pilih Merk
                                HP</label>
                            <input type="text" x-model="searchMerk" x-on:click="openMerk = !openMerk"
                                x-on:input="openMerk = true"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Cari Merk Hp...">

                            <!-- Dropdown Merk -->
                            <div x-show="openMerk" x-transition x-on:click.away="openMerk = false"
                                class="mt-2 max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                                <ul>
                                    <template
                                        x-for="item in itemsMerk.filter(i => i.merk.toLowerCase().includes(searchMerk.toLowerCase()))"
                                        :key="item.id">
                                        <li x-on:click="selectMerk(item)"
                                            class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                                            <span x-text="item.merk"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            @if ($errors->has('merkHpId'))
                                <div
                                    class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                    </svg>
                                    @error('merkHpId')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>




                        <div class="w-1/2">
                            <!-- Dropdown Model HP -->
                            <label for="dropdown" class="block text-sm font-medium text-gray-400">Pilih Model
                                HP</label>
                            <input type="text" x-model="searchModel" x-on:click="openModel = !openModel"
                                x-on:input="openModel = true"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Cari Model Hp..." :disabled="!merkHpId">

                            <!-- Dropdown Model -->
                            <div x-show="openModel && merkHpId" x-transition x-on:click.away="openModel = false"
                                class="mt-2 max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                                <ul>
                                    <template
                                        x-for="item in filteredModels().filter(i => i.model.toLowerCase().includes(searchModel.toLowerCase()))"
                                        :key="item.id">
                                        <li x-on:click="selectModel(item)"
                                            class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                                            <span x-text="item.model"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            @if ($errors->has('modelHpId'))
                                <div
                                    class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                    </svg>
                                    @error('modelHpId')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>



                    <!-- Input Imei-->
                    <div class="mb-4">
                        <label for="imei" class="block text-sm font-medium text-gray-400">Imei</label>
                        <input type="text" id="imei" wire:model="imei"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if ($errors->has('modelHpId'))
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                @error('modelHpId')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>



                    {{-- <label for="service">Service</label>
                            <select id="Service" name="service" wire:model="service_id" data-placeholder="Select Services" multiple
                                data-multi-select>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->nama_servis }}</option>
                                @endforeach
                            </select>
        
                            <div class="mb-4"></div>
                
                            <label for="sparepart">Sparepart</label>
                            <select id="Sparepart" name="sparepart" wire:model="sparepart_id" data-placeholder="Select Spareparts"
                                multiple data-multi-select>
                                @foreach ($spareparts as $sparepart)
                                    <option value="{{ $sparepart->id }}">{{ $sparepart->nama_sparepart }}</option>
                                @endforeach
                            </select> --}}



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
                        <label for="dropdown" class="block text-sm font-medium text-gray-400">Pilih
                            Layanan</label>
                        <input type="text" x-model="search" x-on:click="open = !open" x-on:input="open = true"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Cari Layanan..." :value="displayText">

                        <!-- Dropdown -->
                        <div x-show="open" x-transition x-on:click.away="open = false"
                            class="mt-2  max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                            <ul>
                                <template
                                    x-for="item in items.filter(i => i.nama_servis.toLowerCase().includes(search.toLowerCase()))"
                                    :key="item.id">
                                    <li x-on:click="selectItem(item)"
                                        :class="{ 'bg-indigo-600 text-white': selectedItem && selectedItem.id === item.id }"
                                        class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                                        <span x-text="item.nama_servis"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-4"></div>

                    <div x-data="{
                        open: false,
                        search: '',
                        selectedItems: [],
                        items: @js($spareparts),
                        selectItem(item) {
                            if (this.selectedItems.some(i => i.id === item.id)) {
                                this.selectedItems = this.selectedItems.filter(i => i.id !== item.id);
                            } else {
                                this.selectedItems.push(item);
                            }
                            this.search = '';
                            @this.set('sparepart_id', this.selectedItems.map(i => i.id));
                            @this.set('harga_sparepart', this.selectedItems.map(i => i.harga));
                            this.open = false;
                        },
                        get displayText() {
                            return this.selectedItems.map(i => i.nama_sparepart).join(', ') || 'Pilih Sparepart';
                        }
                    }">
                        <label for="dropdown" class="block text-sm font-medium text-gray-400">Pilih Sparepart</label>
                        <input type="text" x-model="search" x-on:click="open = !open" x-on:input="open = true"
                            wire:model.defer="sparepart_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Cari Sparepart..." :value="displayText">

                        <!-- Tampilkan error jika ada -->
                        @error('sparepart_id')
                            <div
                                class="mt-1 p-2 bg-yellow-100 border border-yellow-400 text-yellow-900 text-xs rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 110 14 7 7 0 010-14z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror


                        <!-- Dropdown -->
                        <div x-show="open" x-transition x-on:click.away="open = false"
                            class="mt-2  max-h-60 overflow-auto border border-gray-300 rounded-md shadow-lg bg-white absolute z-10">
                            <ul>
                                <template
                                    x-for="item in items.filter(i => i.nama_sparepart.toLowerCase().includes(search.toLowerCase()))"
                                    :key="item.id">
                                    <li x-on:click="selectItem(item)"
                                        :class="{ 'bg-indigo-600 text-white': selectedItems.some(i => i.id === item.id) }"
                                        class="cursor-pointer px-4 py-2 hover:bg-indigo-600 hover:text-white">
                                        <span x-text="item.nama_sparepart"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <div class="mb-4"></div>
                        <div id="garansi_check" class="flex items-center">
                            <input type="checkbox" wire:model="garansi" value="1" id="garansi_check">
                            <label for="garansi_check" class="ml-2">Garansi</label>
                        </div>

                    </div>

                </div>

            </div>
            <div class="flex justify-end mr-4 mt-4">
                <button {{-- onclick="if (document.getElementById('nohp').value && document.getElementById('nama').value && document.getElementById('alamat').value && document.getElementById('no_hp_alternatif').value && document.getElementById('kendala').value && document.getElementById('imei').value) { printDiv('spk-print'); }"  --}} 
                type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Simpan
                </button>

            </div>

    </form>


    {{-- DESAI STRUK SPK --}}
   
    <div class="bg-white rounded shadow-md p-4 my-3 w-10" id="spk-print" style="width:80mm;display:none">
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
    window.addEventListener('print-spk', () => {
        printDiv('spk-print');
    });

    function printDiv(divId) {
        let printContent = document.getElementById(divId).innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent; // Hanya menampilkan elemen yang dipilih
        window.print(); // Perintah print
        document.body.innerHTML = originalContent; // Mengembalikan halaman ke tampilan awal
        fetch("{{ route('clear-session') }}", { method: "POST" });
    }
</script>

{{-- <script>
        window.addEventListener('print-spk', (event) => {

       
        printDiv(event);
    });
    function printDiv(data){
        // let inputData = @json(session('inputData')); 
        // Load jsPDF
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        let y = 10; // Vertical position

        // Load image (Base64 or URL)
        let imgUrl = "{{ asset('images/logo_raja.png') }}"; // Laravel Blade syntax

        let img = new Image();
        img.src = imgUrl;
        img.crossOrigin = "Anonymous"; // Fix CORS issues for external images

        doc.addImage(img, "PNG", 90, y, 30, 30); // Adjust position and size
        y += 40;

        // Header: Logo
        doc.setFontSize(18);
        doc.text("Raja Servis HP", 105, y, {
            align: "center"
        });
        y += 10;
        doc.setFontSize(12);
        doc.text("Jl. Raya Kedung Turi No. 1, Kedung Turi, Kec. Sidoarjo,", 105, y, {
            align: "center"
        });
        y += 5;
        doc.text("Kabupaten Sidoarjo, Jawa Timur 61257", 105, y, {
            align: "center"
        });
        y += 10;
        doc.text("Telp. 0812-3456-7890", 105, y, {
            align: "center"
        });
        y += 10;

        doc.setLineWidth(0.5);
        doc.setDrawColor(128, 128, 128); // Set line color to gray with 0.5 opacity
        doc.setLineDash([2, 2]); // Set dashed line pattern
        doc.line(10, y, 200, y); // Dashed line
        doc.setLineDash([]); // Reset to solid line
        y += 10;

        // Booking Code & Date
        doc.setFont("helvetica", "bold");
        doc.setFontSize(14);
        doc.text("#12345678", 105, y, {
            align: "center"
        });

        doc.setFont("helvetica", "normal");
        y += 8;
        doc.setFontSize(12);
        doc.text("Pemesanan: 12-20-2024", 105, y, {
            align: "center"
        });
        y += 10;

        doc.setLineWidth(0.5);
   
        doc.setLineDash([2, 2]); // Set dashed line pattern
        doc.line(10, y, 200, y); // Dashed line
        doc.setLineDash([]); // Reset to solid line
        y += 10;


        
        // Customer Details
        doc.setTextColor(128, 128, 128); // Set text color to gray
        doc.setFontSize(12);
        doc.text("Nama         : John Doe", 20, y);
        y += 10;
        doc.text("No. HP       : 0812-34510-7890", 20, y);
        y += 10;
        doc.text("Merk HP      : Samsung", 20, y);
        y += 10;
        doc.text("Model HP     : SCPA209", 20, y);
        y += 10;
        doc.text("IMEI         : 0812-5678-1234", 20, y);
        y += 10;
        doc.text("Teknisi      : Subagiyo Kirun", 20, y);
        y += 10;


        doc.setLineWidth(0.5);
        doc.setLineDash([2, 2]); // Set dashed line pattern
        doc.line(10, y, 200, y); // Dashed line
        doc.setLineDash([]); // Reset to solid line
        y += 5;

        doc.setTextColor(0, 0, 0); // Set text color to black
        doc.setFont("helvetica", "bold");
        doc.text("Kendala", 105, y, {
            align: "center"
        });

    
        doc.setFont("helvetica", "normal");
        doc.setTextColor(128, 128, 128); // Set text color to gray
        y += 10;
        doc.text(data.kendala, 105, y, {
            align: "center"
        });
        y += 20;
        // Additional Info

        doc.setFont("helvetica", "normal");
        doc.setFontSize(14);
        doc.setTextColor(0, 0, 0); // Set text color to black
        doc.text("Nomor Urut", 105, y, {
            align: "center"
        });
        y += 15;
        doc.setFontSize(40);
        doc.text("07", 105, y, {
            align: "center"
        });
        y += 20;

        doc.setLineWidth(0.5);
        doc.setLineDash([2, 2]); // Set dashed line pattern
        doc.line(10, y, 200, y); // Dashed line
        doc.setLineDash([]); // Reset to solid line
        y += 10;

        // Footer
        y += 20;
        doc.setFontSize(16);
        doc.text("TERIMAKASIH", 105, y, {
            align: "center"
        });

        // Save the PDF
        doc.save("sample.pdf");
    };
</script> --}}



<script>
    window.addEventListener('customer-not-found', event => {
        alert(event.detail.message);
    });
</script>
