<div class="flex justify-center items-center min-h-screen relative" style="background-image: url('{{ asset('images/loginnn.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0" ></div>
    <div class="relative ">
        <div class="flex bg-white shadow-md max-w-4xl max-h-4xl overflow-hidden rounded-lg">
            <div class="w-2/4 px-12 py-20">
                <div class="flex justify-center mb-4">
                    {{ $logo }}
                </div>
                {{ $slot }}
            </div>
            <div class="w-1/2">
                <img src="{{ asset('images/bg_login_work.jpg') }}" class="w-full h-full object-cover" alt="login image">
            </div>
        </div>
     
        <h1 class="text-white mt-4 text-center" style="opacity: 0.7"><p>Copyright © {{ now()->year }} || REACTIVE</p>
</h1>
    </div>

</div>



