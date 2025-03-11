<div class="bg-white  rounded-lg shadow-xl w-full max-w-md flex flex-col items-center justify-center">
    <div class="flex justify-center bg-white rounded-lg shadow-xl w-full max-w-md relative pt-4">
        <img src="{{ asset('images/raja_repair.svg') }}" alt="logo"
            class="w-[150px] bg-white p-2 \">
    </div>
    <div class="p-6 flex flex-col items-center justify-center">

        {{-- <form action="{{ route('cs.rating') }}" method="POST" class="flex flex-col items-center mb-2 mt-4">
            @csrf
            <div class="rating flex">
                <input type="radio" id="star1" name="rating" value="1" onclick="setRating(1)"
                    style="display: none;">
                <label for="star1" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                        id="star1-icon"></i></label>
                <input type="radio" id="star2" name="rating" value="2" onclick="setRating(2)"
                    style="display: none;">
                <label for="star2" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                        id="star2-icon"></i></label>
                <input type="radio" id="star3" name="rating" value="3" onclick="setRating(3)"
                    style="display: none;">
                <label for="star3" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                        id="star3-icon"></i></label>
                <input type="radio" id="star4" name="rating" value="4" onclick="setRating(4)"
                    style="display: none;">
                <label for="star4" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                        id="star4-icon"></i></label>
                <input type="radio" id="star5" name="rating" value="5" onclick="setRating(5)"
                    style="display: none;">
                <label for="star5" class="mr-4"><i class="far fa-star fa-2x" style="color: #FFD43B;"
                        id="star5-icon"></i></label>
            </div>

            <div class="flex justify-center mt-5">

                <button class="bg-[#5346AE] text-white px-4 py-2 rounded"
                    onclick="showPopup()">Submit</button>
            </div>
        </form> --}}
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
                <div class="mb-4">
                    <label for="nota" class="block text-gray-700">Masukkan Nota:</label>
                    <input type="text" id="nota" wire:model="nota" class="border p-2 rounded"
                        placeholder="Masukkan Nota">
                </div>

            <!-- Tombol untuk Validasi Nota -->
            <button wire:click="validateNota" class="bg-blue-500 text-white p-2 rounded">
                Validasi Nota
            </button>
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
