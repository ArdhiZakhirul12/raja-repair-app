<div class="bg-white  rounded-lg shadow-xl w-full max-w-md flex flex-col items-center justify-center relative">
    <div class="flex justify-center bg-white rounded-lg shadow-xl w-full max-w-md  py-4">
        <img src="{{ asset('images/reactive.png') }}" alt="logo"

            class="w-[150px] bg-white p-2 \">

    </div>
    <div class="p-6 flex flex-col items-center justify-center">

       
        <div class="flex flex-col items-center">
            <h1 class="text-lg text-center mb-4 text-gray-500 mt-4">
                Bagaimana penilaian anda terhadap pelayanan kami?
            </h1>

            @if (session()->has('message'))
                <div class="bg-green-100 text-green-700 p-2 mt-2 rounded mb-2">
                    {{ session('message') }}
                </div>

     
            @endif

            @if (session()->has('error'))
                <div id="ratingErrorMessage" class="bg-red-100 text-red-700 p-2 mt-2 rounded mb-2">
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
            <button wire:click="validateNota" class="bg-orange-600 text-white p-2 rounded">
                Validasi
            </button>
                </div>

         
            @endif

            @if ($isValid == true)
                <!-- Rating Emoji -->
                {{-- {{$rating}} --}}
                <div class="flex space-x-6">
                    <div class="justify-center items-center flex flex-col">
                        <button wire:click="setRating(3)" >
                            <span class="text-5xl transition-all duration-300 {{ $rating === 3 || $rating === null ? '' : 'opacity-50' }}">
                                😊
                            </span>
                        </button>
                        <h1 class="{{ $rating === 3 || $rating === null ? '' : 'opacity-50' }}">Sangat Puas</h1>
                    </div>
           
                    <div class="justify-center items-center flex flex-col">
                        <button wire:click="setRating(2)" >
                            <span class="text-5xl transition-all duration-300 {{ $rating === 2 || $rating === null ? '' : 'opacity-50' }}">
                                😐
                            </span>
                        </button>
                        <h1 class="{{ $rating === 2 || $rating === null ? '' : 'opacity-50' }}">Puas</h1>
                    </div>

                    <div class="justify-center items-center flex flex-col">
                        <button wire:click="setRating(1)"   >
                            <span class="text-5xl transition-all duration-300 {{ $rating === 1 || $rating === null ? '' : 'opacity-50' }}">
                                😞
                            </span>
                        </button>
                        <h1 class="{{ $rating === 1 || $rating === null ? 'text-black' : 'opacity-50' }}">Tidak Puas</h1>
                    </div>
                </div>
                {{-- $set('isModalDokumen', true) --}}

                <button wire:click="submit" class="bg-[#5346AE] text-white px-4 py-2 rounded mt-5">
                    Submit
                </button>
            @endif

        </div>



    </div>

</div>
