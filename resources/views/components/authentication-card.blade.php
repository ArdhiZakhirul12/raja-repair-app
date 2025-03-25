<div class="flex justify-center items-center min-h-screen relative" style="background-image: url('{{ asset('images/raja_repair_bg_login.svg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0" style="background-color: #3D3480; opacity: 0.8;"></div>
    <div class="relative flex bg-white shadow-md max-w-4xl max-h-4xl overflow-hidden rounded-lg">
        <div class="w-2/4 px-12 py-20">
            <div class="flex justify-center mb-4">
                {{ $logo }}
            </div>
            {{ $slot }}
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/login_raja_side_bg.svg') }}" class="w-full h-full object-cover" alt="login image">
        </div>
    </div>
    <h1>TEXT</h1>
</div>



