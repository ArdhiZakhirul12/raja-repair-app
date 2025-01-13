<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="flex bg-white shadow-md max-w-4xl max-h-4xl overflow-hidden rounded-lg">
        <div class="w-2/4 px-12 py-20">
            <div class="flex justify-center mb-4">
            {{ $logo }}
            </div>
            {{ $slot }}
        </div>
        <div class="w-1/2">
            <img src="{{ asset('images/login_bg.jpg') }}" class="w-full h-full object-cover" alt="login image">
        </div>
    </div>
</div>


