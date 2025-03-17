<div class="bg-white  rounded-lg shadow-xl w-full max-w-md flex flex-col items-center justify-center relative">
    <div class="flex justify-center bg-white rounded-lg shadow-xl w-full max-w-md  pt-4">
        <img src="{{ asset('images/raja_repair.svg') }}" alt="logo"

            class="w-[150px] bg-white p-2 \">

    </div>
    <div class="p-6 flex flex-col items-center justify-center">

       
        <div class="flex flex-col items-center">
            <h1 class="text-lg text-center mb-4 text-gray-500 mt-4">
                Bagaimana penilaian anda terhadap pelayanan kami?
            </h1>

            @if (session()->has('message'))
                <div class="bg-green-100 text-green-700 p-2 mt-2 rounded">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 text-red-700 p-2 mt-2 rounded">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errorMessage)
                <p class="text-red-500 mt-2">{{ $errorMessage }}</p>
            @endif
            @if ($isValid == false)
            
                <div class="mb-4 flex ">
                    {{-- <label for="nota" class="block text-gray-700">Masukkan Nomor Nota:</label> --}}
                    <input type="text" id="nota" wire:model="nota" class="border p-2 rounded mr-4"
                        placeholder="Masukkan Nomor Nota">

                       <!-- Tombol untuk Validasi Nota -->
            <button wire:click="validateNota" class="bg-[#5346AE] text-white p-2 rounded">
                Validasi
            </button>
                </div>

         
            @endif

            @if ($isValid == true)
                <!-- Rating Emoji -->
                {{$rating}}

                <div class="flex space-x-6">
                    <button wire:click="setRating(3)">
                        <span class="text-5xl transition-all duration-300"
                            class="{{ $rating === 3 ? 'scale-100' : 'scale-80' }}">
                            😊
                        </span>
                    </button>

                    <button wire:click="setRating(2)">
                        <span class="text-5xl transition-all duration-300"
                            class="{{ $rating === 2 ? 'scale-125' : 'scale-100' }}">
                            😐
                        </span>
                    </button>

                    <button wire:click="setRating(1)">
                        <span class="text-5xl transition-all duration-300"
                            class="{{ $rating === 1 ? 'scale-125' : 'scale-100' }}">
                            😞
                        </span>
                    </button>
                </div>
                {{-- $set('isModalDokumen', true) --}}

                <button wire:click="submit" class="bg-[#5346AE] text-white px-4 py-2 rounded mt-5">
                    Submit
                </button>
            @endif

        </div>



    </div>

</div>
