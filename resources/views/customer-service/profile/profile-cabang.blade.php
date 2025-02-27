<x-app-layout>
    <div class=" m-8">
        <div class="sm:mb-5">
            <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">
                Informasi Cabang
            </h1>
        </div>
        <div class="p-4 bg-white dark:bg-black shadow rounded-lg w-full">
            <div class="flex items-center">
                {{-- <img src="{{ asset('images/Analytics.svg') }}" alt="logo" class="w-7 mr-3"> --}}
                <div class="bg-white rounded-lg shadow p-4 mr-4">
                    <i class="fa-solid fa-address-card text-4xl" style="color: #74C0FC;"></i>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl text-gray-800 dark:text-gray-100 font-bold mb-2">
                        {{ $cabang_data->nama }}
                    </h1>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a6 6 0 00-6 6c0 4.418 6 10 6 10s6-5.582 6-10a6 6 0 00-6-6zm0 8a2 2 0 110-4 2 2 0 010 4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $cabang_data->alamat }}</p>
                    </div>
                    
                </div>

                <div class="ml-auto flex items-center p-3 bg-green-100 text-green-500 rounded-lg">
                    <i class="fa-solid fa-phone fa-shake mr-3" style="color: #63E6BE;"></i>
                    <h1>
                        {{ $cabang_data->no_hp }}
                    </h1>
                </div>
            </div>
          

        </div>

    </div>


</x-app-layout>